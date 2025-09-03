#!/bin/bash

# Script per verificare duplicazioni di trait nelle catene di ereditarietà
# Identifica modelli che ridichiarano trait già presenti nelle classi base

set -e

LARAVEL_DIR="/var/www/html/_bases/base_saluteora/laravel"
MODULES_DIR="$LARAVEL_DIR/Modules"

echo "🔍 Controllo duplicazioni trait nelle catene di ereditarietà..."
echo "================================================================"

ERRORS_FOUND=0

# Trait comuni da verificare
COMMON_TRAITS=("HasFactory" "SoftDeletes" "BelongsToTenant" "Updater" "LogsActivity" "HasMedia")

for module_dir in "$MODULES_DIR"/*; do
    if [ ! -d "$module_dir" ]; then
        continue
    fi
    
    MODULE_NAME=$(basename "$module_dir")
    MODELS_DIR="$module_dir/app/Models"
    
    if [ ! -d "$MODELS_DIR" ]; then
        continue
    fi
    
    echo "📦 Controllo modulo: $MODULE_NAME"
    
    # Trova BaseModel del modulo
    BASE_MODEL="$MODELS_DIR/BaseModel.php"
    
    if [ ! -f "$BASE_MODEL" ]; then
        echo "   ⚠️  BaseModel.php non trovato"
        continue
    fi
    
    # Estrai trait dal BaseModel
    BASE_TRAITS=$(grep -o "use [A-Za-z\\]*;" "$BASE_MODEL" | grep -v "namespace\|class" | sed 's/use //g' | sed 's/;//g' | sed 's/.*\\\///')
    
    echo "   📋 Trait in BaseModel: $BASE_TRAITS"
    
    # Verifica ogni modello figlio
    for model_file in "$MODELS_DIR"/*.php; do
        if [ "$(basename "$model_file")" = "BaseModel.php" ]; then
            continue
        fi
        
        MODEL_NAME=$(basename "$model_file" .php)
        
        # Verifica se estende BaseModel
        if ! grep -q "extends BaseModel" "$model_file"; then
            continue
        fi
        
        # Verifica duplicazioni trait
        for trait in $BASE_TRAITS; do
            if grep -q "use $trait" "$model_file"; then
                echo "   ❌ $MODEL_NAME.php: Duplicazione trait '$trait'"
                ERRORS_FOUND=$((ERRORS_FOUND + 1))
            fi
        done
        
        # Verifica metodo newFactory() duplicato se HasFactory è in BaseModel
        if echo "$BASE_TRAITS" | grep -q "HasFactory"; then
            if grep -q "function newFactory" "$model_file"; then
                echo "   ❌ $MODEL_NAME.php: Metodo newFactory() duplicato"
                ERRORS_FOUND=$((ERRORS_FOUND + 1))
            fi
        fi
    done
    
    if [ "$ERRORS_FOUND" -eq 0 ]; then
        echo "   ✅ Modulo $MODULE_NAME: Nessuna duplicazione trait"
    fi
    
    echo ""
done

echo "================================================================"

if [ "$ERRORS_FOUND" -eq 0 ]; then
    echo "🎉 Tutte le catene di ereditarietà sono pulite!"
    exit 0
else
    echo "❌ Trovate $ERRORS_FOUND violazioni di ereditarietà"
    echo ""
    echo "📋 Azioni richieste:"
    echo "1. Rimuovere trait duplicati dai modelli figli"
    echo "2. Rimuovere metodi newFactory() se HasFactory è in BaseModel"
    echo "3. Verificare che solo BaseModel contenga trait comuni"
    echo "4. Aggiornare documentazione catena ereditarietà"
    echo ""
    echo "📖 Guida: docs/inheritance_chain_critical_rules.md"
    exit 1
fi
