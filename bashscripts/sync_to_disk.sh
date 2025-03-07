#!/bin/bash

# Verifica se è stato passato il nome del disco
if [ -z "$1" ]; then
    echo "Uso: $0 <nome_disco>"
    exit 1
fi

DISK_NAME=$1
DEST_PATH="/mnt/$DISK_NAME$PWD"
me=$( readlink -f -- "$0";)

echo "Sincronizzazione in corso da '$PWD' a '$DEST_PATH'..."
find . -type f -name "*:Zone.Identifier" -exec rm -f {} \;
rsync -avz --relative --exclude='.git' --exclude='build' --exclude='cache'  --exclude='storage' --exclude='venv' --exclude='node_modules' --exclude='vendor' --exclude='stubs' ./ "$DEST_PATH"
sed -i -e 's/\r$//' "$me"
echo "Sincronizzazione completata!"
