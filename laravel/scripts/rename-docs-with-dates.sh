#!/bin/bash

# Script per rinominare file docs con date nei nomi
# Rimuove pattern YYYY-MM-DD dai nomi file

echo "🔍 Cercando file docs con date nei nomi..."

# Trova tutti i file con date nei nomi
files_with_dates=$(find . -path "*/docs/*" -name "*[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]*" -type f)

if [ -z "$files_with_dates" ]; then
    echo "✅ Nessun file con date trovato!"
    exit 0
fi

echo "📁 File trovati con date:"
echo "$files_with_dates"
echo ""

# Rinomina ogni file rimuovendo la data
while IFS= read -r file; do
    if [ -f "$file" ]; then
        # Estrai directory e nome file
        dir=$(dirname "$file")
        filename=$(basename "$file")
        
        # Rimuovi pattern data (YYYY-MM-DD)
        new_filename=$(echo "$filename" | sed 's/-[0-9]\{4\}-[0-9]\{2\}-[0-9]\{2\}//g')
        
        # Se il nome è cambiato, rinomina
        if [ "$filename" != "$new_filename" ]; then
            new_path="$dir/$new_filename"
            
            # Controlla se il file target esiste già
            if [ -f "$new_path" ]; then
                echo "⚠️  SKIP: $new_path esiste già"
                echo "   Source: $file"
            else
                echo "🔄 Rinomino: $filename → $new_filename"
                mv "$file" "$new_path"
                echo "✅ Completato: $new_path"
            fi
        fi
    fi
done <<< "$files_with_dates"

echo ""
echo "🎯 Rinominazione completata!"
echo "📊 Verifica finale..."

# Verifica che non ci siano più file con date
remaining=$(find . -path "*/docs/*" -name "*[0-9][0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9]*" -type f | wc -l)

if [ "$remaining" -eq 0 ]; then
    echo "✅ Tutti i file con date sono stati rinominati!"
else
    echo "⚠️  Rimangono $remaining file con date da gestire manualmente"
fi










