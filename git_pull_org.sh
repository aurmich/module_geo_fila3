#!/bin/sh

# Controllo parametri
if [ "$#" -ne 2 ]; then
    echo "Utilizzo: $0 <nuova-organizzazione> <branch>"
    exit 1
fi

NEW_ORG="$1"
BRANCH="$2"

# Nome dello script stesso per la chiamata ricorsiva
ME=$(readlink -f -- "$0")
WHERE=$(pwd)

# Ottiene il nome della repository corrente
REPO_NAME=$(basename "$(git rev-parse --show-toplevel)")

# Costruisce il nuovo URL remoto
NEW_REMOTE="git@github.com:$NEW_ORG/$REPO_NAME.git"

echo "📥 [MAIN] Pull da $NEW_REMOTE (branch: $BRANCH)"

# Configurazioni globali per evitare problemi
git config core.fileMode false
git config core.ignorecase false
git config advice.skippedCherryPicks false

# Sincronizzazione submoduli
git submodule sync --recursive
git submodule update --progress --init --recursive --force --merge --rebase --remote
git submodule foreach "$ME" "$NEW_ORG" "$BRANCH"

# Fetch delle ultime modifiche dal repository principale
git fetch origin --progress --prune

# Checkout del branch corretto
if git show-ref --verify --quiet refs/heads/"$BRANCH"; then
    git checkout "$BRANCH"
else
    git checkout -t origin/"$BRANCH" || git checkout -b "$BRANCH"
fi

# Pull con gestione dei conflitti
git pull --rebase origin "$BRANCH" --autostash --recurse-submodules --allow-unrelated-histories --prune --progress -v || {
    echo "Rebase failed, attempting conflict resolution..."
    
    # Tentativo di continuare il rebase automaticamente
    if git rebase --continue; then
        echo "Rebase continued successfully."
    else
        echo "Rebase conflicts detected. Attempting automatic resolution..."

        # Risoluzione automatica dei conflitti prendendo la versione remota
        git diff --name-only --diff-filter=U | while read file; do
            git checkout --theirs "$file"
            git add "$file"
        done

        # Proviamo a completare il rebase
        git rebase --continue || {
            echo "Rebase auto-fix failed. Aborting..."
            git rebase --abort
            echo "Attempting merge instead..."
            git merge origin/$BRANCH || {
                echo "Merge also failed. Manual intervention required!"
                exit 1
            }
        }
    fi
}

# Normalizzazione e commit automatico se ci sono modifiche
git add --renormalize -A
git commit -am "Auto-update" || echo '⚠️ Nessuna modifica da committare'

# Push con gestione di eventuali errori
git push origin "$BRANCH" --progress || {
    echo "Push failed, attempting rebase and retry..."
    git pull --rebase origin "$BRANCH" && git push origin "$BRANCH"
}

echo "✅ PUSH COMPLETATO [$WHERE ($BRANCH)]"

# Configurazione tracking del branch
if ! git rev-parse --abbrev-ref --symbolic-full-name "@{u}" >/dev/null 2>&1; then
    git branch --set-upstream-to=origin/$BRANCH "$BRANCH" || true
    git branch -u origin/$BRANCH || true
fi

# Aggiornamento finale dei submoduli e pull dalla nuova organizzazione
git submodule update --progress --init --recursive --force --merge --rebase --remote
git pull "$NEW_REMOTE" "$BRANCH" --autostash --recurse-submodules --allow-unrelated-histories --prune --progress -v --rebase

echo "✅ PULL COMPLETATO [$WHERE ($BRANCH)]"
