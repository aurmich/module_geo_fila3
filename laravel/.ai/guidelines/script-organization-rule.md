# 📂 Script Organization Rule

## ✅ CORRECT LOCATION

All shell scripts must be placed in:

```bash
# ✅ CORRECT - Use existing bashscripts directory
bashscripts/
├── detect-basemodel-violations.sh
├── fix-docs-uppercase.sh
├── analysis/
├── backup/
├── docs/
├── fix/
├── git-management/
└── ... (other organized subdirectories)
```

## ❌ FORBIDDEN LOCATIONS

```bash
# ❌ FORBIDDEN - Never create these
scripts/
bin/
shell/
tools/
```

## 🎯 Motivation

The project already has an established `bashscripts/` directory with:
- Organized subdirectories by category
- Consistent naming conventions
- Existing script ecosystem
- Proper documentation structure

## 📋 Script Organization Categories

### `/bashscripts/analysis/` - Analysis and auditing scripts
### `/bashscripts/backup/` - Backup and restore operations  
### `/bashscripts/docs/` - Documentation maintenance
### `/bashscripts/fix/` - Error fixing and corrections
### `/bashscripts/git-management/` - Git operations
### `/bashscripts/` (root) - General utility scripts

## 🔧 Implementation Rule

When creating new scripts:
1. **Always check** if `bashscripts/` exists (it does)
2. **Use appropriate subdirectory** based on script purpose
3. **Never create** alternative script directories
4. **Follow existing naming** conventions in bashscripts

---

**Status**: ✅ **Active Rule**  
**Compliance**: **Mandatory**