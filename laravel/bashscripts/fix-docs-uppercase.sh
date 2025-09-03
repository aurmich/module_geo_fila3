#!/bin/bash

# Script to rename all uppercase documentation files to lowercase (kebab-case)
# Exception: README.md files are kept as-is

set -e

log_file="/tmp/docs_rename_$(date +%Y%m%d_%H%M%S).log"
echo "Fixing uppercase documentation filenames..." | tee -a "$log_file"
echo "Log file: $log_file"

renamed_count=0
skipped_count=0

# Function to convert filename to kebab-case
to_kebab_case() {
    local filename="$1"
    
    # Skip README.md
    if [[ "$filename" == "README.md" ]]; then
        echo "$filename"
        return
    fi
    
    # Extract extension
    local name="${filename%.*}"
    local ext="${filename##*.}"
    
    # Convert to kebab-case
    local kebab_name=$(echo "$name" | \
        sed 's/([^)]*)//g' | \
        sed 's/[[:space:]]\+/-/g' | \
        sed 's/[^a-zA-Z0-9]/-/g' | \
        sed 's/--\+/-/g' | \
        sed 's/^-\+\|-\+$//g' | \
        tr '[:upper:]' '[:lower:]')
    
    echo "${kebab_name}.${ext}"
}

# Process each module
for module_path in Modules/*/docs; do
    if [[ ! -d "$module_path" ]]; then
        continue
    fi
    
    module_name=$(basename $(dirname "$module_path"))
    echo "Processing module: $module_name" | tee -a "$log_file"
    
    # Find all .md files with uppercase characters (excluding README.md)
    find "$module_path" -name "*.md" -type f | while read -r file; do
        filename=$(basename "$file")
        dir=$(dirname "$file")
        
        # Skip README.md
        if [[ "$filename" == "README.md" ]]; then
            echo "  SKIP: $filename (allowed exception)" | tee -a "$log_file"
            ((skipped_count++))
            continue
        fi
        
        # Check if filename has uppercase
        if [[ "$filename" =~ [A-Z] ]]; then
            new_filename=$(to_kebab_case "$filename")
            new_path="$dir/$new_filename"
            
            # Only rename if the new name is different
            if [[ "$filename" != "$new_filename" ]]; then
                echo "  RENAME: $filename -> $new_filename" | tee -a "$log_file"
                
                # Check if target file already exists
                if [[ -f "$new_path" ]]; then
                    echo "    WARNING: Target file already exists: $new_filename" | tee -a "$log_file"
                    echo "    SKIP: $filename" | tee -a "$log_file"
                    continue
                fi
                
                # Rename the file
                mv "$file" "$new_path"
                ((renamed_count++))
            else
                echo "  SKIP: $filename (no changes needed)" | tee -a "$log_file"
                ((skipped_count++))
            fi
        else
            echo "  SKIP: $filename (already lowercase)" | tee -a "$log_file"
            ((skipped_count++))
        fi
    done
done

echo "" | tee -a "$log_file"
echo "Summary:" | tee -a "$log_file"
echo "- Files renamed: $renamed_count" | tee -a "$log_file"  
echo "- Files skipped: $skipped_count" | tee -a "$log_file"
echo "- Log file: $log_file" | tee -a "$log_file"
echo "" | tee -a "$log_file"
echo "✅ Documentation filename standardization completed!" | tee -a "$log_file"