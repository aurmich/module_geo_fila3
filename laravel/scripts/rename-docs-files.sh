#!/bin/bash

# Script per rinominazione sistematica file docs secondo standard SaluteOra
# Principi: inglese, kebab-case, no date, lowercase (eccetto README.md)

echo "🔄 Avvio sistematizzazione file documentazione..."

# Contatori per statistiche
RENAMED_COUNT=0
DELETED_COUNT=0
ERROR_COUNT=0

# Funzione per rinominare file
rename_file() {
    local old_file="$1"
    local new_file="$2"
    
    if [ "$old_file" != "$new_file" ] && [ -f "$old_file" ]; then
        if [ -f "$new_file" ]; then
            echo "⚠️  Target exists: $new_file - removing duplicate $old_file"
            rm "$old_file"
            ((DELETED_COUNT++))
        else
            mv "$old_file" "$new_file"
            echo "✅ Renamed: $(basename "$old_file") → $(basename "$new_file")"
            ((RENAMED_COUNT++))
        fi
    fi
}

# 1. Rimuovi date dai nomi file
echo "📅 Rimozione date dai nomi file..."
find Modules/*/docs -name "*.md" | grep -E "[0-9]{4}-[0-9]{2}-[0-9]{2}" | while read file; do
    # Rimuovi pattern data dalla fine del nome
    new_file=$(echo "$file" | sed 's/-[0-9]\{4\}-[0-9]\{2\}-[0-9]\{2\}\.md$/.md/')
    
    # Se il file risultante ha un nome generico, migliora il nome
    case "$(basename "$new_file")" in
        "correzioni-completate.md")
            new_file="$(dirname "$new_file")/fixes-completed.md"
            ;;
        "traduzioni-appointment-correzioni.md")
            new_file="$(dirname "$new_file")/appointment-translation-fixes.md"
            ;;
        "verifica-traduzioni-template-pdf.md")
            new_file="$(dirname "$new_file")/pdf-template-translation-verification.md"
            ;;
        "translation-refactor-complete-summary.md")
            new_file="$(dirname "$new_file")/translation-refactor-summary.md"
            ;;
        "enum-translation-pattern-implementation.md")
            new_file="$(dirname "$new_file")/enum-translation-patterns.md"
            ;;
        "lang-service-translation-updates.md")
            new_file="$(dirname "$new_file")/lang-service-updates.md"
            ;;
        "address-translation-fixes.md")
            new_file="$(dirname "$new_file")/address-translation-fixes.md"
            ;;
        "helper-text-normalization-fix.md")
            new_file="$(dirname "$new_file")/helper-text-normalization.md"
            ;;
        "sintassi-array-correzione.md")
            new_file="$(dirname "$new_file")/array-syntax-fixes.md"
            ;;
        "project-analysis.md")
            new_file="$(dirname "$new_file")/project-analysis.md"
            ;;
        "translation-refactor-summary.md")
            new_file="$(dirname "$new_file")/translation-refactor-summary.md"
            ;;
    esac
    
    rename_file "$file" "$new_file"
done

# 2. Converti underscore in trattini
echo "🔗 Conversione underscore in trattini..."
find Modules/*/docs -name "*.md" | grep "_" | while read file; do
    new_file=$(echo "$file" | tr '_' '-')
    rename_file "$file" "$new_file"
done

# 3. Traduci termini italiani comuni
echo "🌍 Traduzione termini italiani in inglese..."
find Modules/*/docs -name "*.md" | while read file; do
    new_file="$file"
    
    # Traduzioni comuni
    new_file=$(echo "$new_file" | sed 's/ottimizzazioni/optimization-analysis/g')
    new_file=$(echo "$new_file" | sed 's/sicurezza/security-guidelines/g')
    new_file=$(echo "$new_file" | sed 's/analisi/analysis/g')
    new_file=$(echo "$new_file" | sed 's/linee-guida/guidelines/g')
    new_file=$(echo "$new_file" | sed 's/correzioni/fixes/g')
    new_file=$(echo "$new_file" | sed 's/traduzioni/translations/g')
    new_file=$(echo "$new_file" | sed 's/verifica/verification/g')
    new_file=$(echo "$new_file" | sed 's/implementazione/implementation/g')
    new_file=$(echo "$new_file" | sed 's/risoluzione/resolution/g')
    new_file=$(echo "$new_file" | sed 's/problemi/issues/g')
    new_file=$(echo "$new_file" | sed 's/miglioramenti/improvements/g')
    
    if [ "$file" != "$new_file" ]; then
        rename_file "$file" "$new_file"
    fi
done

# 4. Converti maiuscole in minuscole (eccetto README.md)
echo "📝 Conversione maiuscole in minuscole..."
find Modules/*/docs -name "*.md" | grep -v "README.md" | grep "[A-Z]" | while read file; do
    dir=$(dirname "$file")
    filename=$(basename "$file")
    new_filename=$(echo "$filename" | tr '[:upper:]' '[:lower:]')
    new_file="$dir/$new_filename"
    
    rename_file "$file" "$new_file"
done

# 5. Rimuovi file duplicati di ottimizzazione
echo "🗑️  Rimozione duplicati di ottimizzazione..."
find Modules/*/docs -name "*optimization*" | while read file; do
    # Se esiste già optimization-analysis.md nella stessa directory, rimuovi altri file simili
    dir=$(dirname "$file")
    if [ -f "$dir/optimization-analysis.md" ] && [ "$(basename "$file")" != "optimization-analysis.md" ]; then
        echo "🗑️  Removing duplicate: $(basename "$file")"
        rm "$file"
        ((DELETED_COUNT++))
    fi
done

echo ""
echo "📊 STATISTICHE COMPLETAMENTO:"
echo "✅ File rinominati: $RENAMED_COUNT"
echo "🗑️  File rimossi: $DELETED_COUNT"  
echo "❌ Errori: $ERROR_COUNT"
echo ""
echo "🎉 Sistematizzazione completata!"
echo "📋 Verifica manuale richiesta per link interni"

