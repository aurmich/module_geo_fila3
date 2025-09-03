#!/bin/bash

# Script to detect BaseModel inheritance violations
# Finds models that extend BaseModel but incorrectly include HasFactory or newFactory()

set -e

log_file="/tmp/basemodel_violations_$(date +%Y%m%d_%H%M%S).log"
echo "🔍 Scanning for BaseModel inheritance violations..." | tee -a "$log_file"
echo "Log file: $log_file"

violations_found=0
total_models=0

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
NC='\033[0m' # No Color

# Function to check if a model extends BaseModel (from Xot module)
extends_xot_basemodel() {
    local file="$1"
    # Check if it extends BaseModel and imports from Modules\Xot\Models or just "extends BaseModel"
    if grep -q "extends BaseModel" "$file" && (grep -q "use Modules\\\\Xot\\\\Models\\\\BaseModel" "$file" || ! grep -q "namespace.*BaseModel" "$file"); then
        return 0
    fi
    return 1
}

# Function to check for HasFactory violation
has_factory_violation() {
    local file="$1"
    if grep -q "use.*HasFactory" "$file" && extends_xot_basemodel "$file"; then
        return 0
    fi
    return 1
}

# Function to check for newFactory() violation  
has_newfactory_violation() {
    local file="$1"
    if grep -q "function newFactory" "$file" && extends_xot_basemodel "$file"; then
        return 0
    fi
    return 1
}

echo "" | tee -a "$log_file"
echo "=== SCANNING ALL MODEL FILES ===" | tee -a "$log_file"
echo "" | tee -a "$log_file"

# Find all model files in modules
find Modules -name "*.php" -path "*/app/Models/*" -type f | while read -r file; do
    total_models=$((total_models + 1))
    model_name=$(basename "$file" .php)
    module_name=$(echo "$file" | cut -d'/' -f2)
    
    # Skip BaseModel files themselves
    if [[ "$model_name" == "BaseModel" ]]; then
        echo "  SKIP: $module_name/$model_name (is BaseModel itself)" | tee -a "$log_file"
        continue
    fi
    
    # Check if extends BaseModel from Xot
    if ! extends_xot_basemodel "$file"; then
        echo "  SKIP: $module_name/$model_name (doesn't extend Xot BaseModel)" | tee -a "$log_file"
        continue
    fi
    
    echo "  SCAN: $module_name/$model_name" | tee -a "$log_file"
    
    # Check for violations
    has_factory_viol=false
    has_newfactory_viol=false
    
    if has_factory_violation "$file"; then
        echo -e "    ${RED}❌ VIOLATION: HasFactory trait found${NC}" | tee -a "$log_file"
        has_factory_viol=true
        violations_found=$((violations_found + 1))
    fi
    
    if has_newfactory_violation "$file"; then
        echo -e "    ${RED}❌ VIOLATION: newFactory() method found${NC}" | tee -a "$log_file"
        has_newfactory_viol=true
        violations_found=$((violations_found + 1))
    fi
    
    if [[ "$has_factory_viol" == "false" && "$has_newfactory_viol" == "false" ]]; then
        echo -e "    ${GREEN}✅ CLEAN: No violations${NC}" | tee -a "$log_file"
    fi
    
done

echo "" | tee -a "$log_file"
echo "=== SCAN COMPLETE ===" | tee -a "$log_file"
echo "Total models scanned: $total_models" | tee -a "$log_file"
echo "Violations found: $violations_found" | tee -a "$log_file"

if [[ $violations_found -gt 0 ]]; then
    echo -e "${RED}🚨 CRITICAL: $violations_found BaseModel inheritance violations found!${NC}" | tee -a "$log_file"
    echo "" | tee -a "$log_file"
    echo "=== FIXING VIOLATIONS ===" | tee -a "$log_file"
    echo "Run the following commands to fix:" | tee -a "$log_file"
    echo "" | tee -a "$log_file"
    
    # Find and suggest fixes
    find Modules -name "*.php" -path "*/app/Models/*" -type f | while read -r file; do
        if extends_xot_basemodel "$file" && [[ $(basename "$file" .php) != "BaseModel" ]]; then
            if has_factory_violation "$file"; then
                echo "# Remove HasFactory from $file" | tee -a "$log_file"
                echo "sed -i '/use.*HasFactory/d' '$file'" | tee -a "$log_file"
            fi
            
            if has_newfactory_violation "$file"; then
                echo "# Remove newFactory() method from $file" | tee -a "$log_file"  
                echo "# Manual edit required to remove newFactory() method" | tee -a "$log_file"
            fi
        fi
    done
    
    exit 1
else
    echo -e "${GREEN}✅ SUCCESS: No BaseModel inheritance violations found!${NC}" | tee -a "$log_file"
    exit 0
fi