# 🚨 CRITICAL RULE: Forbidden Documentation Directories

## ❌ ABSOLUTE PROHIBITION

These directories **MUST NEVER EXIST**:

```bash
# FORBIDDEN - Root level docs
/var/www/html/_bases/base_saluteora/docs/
/var/www/html/_bases/base_saluteora/laravel/docs/

# FORBIDDEN - Any docs outside modules
docs/
docs_project/
archive/docs/
```

## ✅ ONLY ALLOWED LOCATION

Documentation **MUST ONLY** exist in:

```bash
# CORRECT - Module-specific docs only
Modules/Activity/docs/
Modules/Cms/docs/
Modules/Geo/docs/
Modules/User/docs/
# ... etc for each module
```

## 🎯 Critical Motivations

### 1. **Modular Architecture Integrity**
- Each module is self-contained and autonomous
- Documentation belongs WITH the code it documents
- Prevents architectural violations

### 2. **Cognitive Load Reduction**
- Developers know exactly where to find documentation
- No confusion about documentation location
- Single source of truth per module

### 3. **Maintainability Excellence**
- Eliminates documentation duplication
- Prevents outdated scattered documentation
- Ensures documentation stays synchronized with code

### 4. **Navigation Logic**
- Documentation is where developers expect it
- Follows universal modular architecture patterns
- Reduces context switching

### 5. **Version Control Clarity**
- Each module's documentation evolves with its code
- Clear ownership and responsibility
- Better git history tracking

## 🔧 Enforcement Rules

### Immediate Actions Required
1. **Delete any root-level docs directories**
2. **Move relevant content to appropriate modules**
3. **Archive obsolete documentation**
4. **Update all links and references**

### Prevention Measures
```bash
# Add to .gitignore at root level
/docs/
/docs_project/
/archive/docs/
```

### Validation Script
```bash
#!/bin/bash
# validate-no-root-docs.sh
if [ -d "docs/" ] || [ -d "../docs/" ]; then
    echo "❌ CRITICAL ERROR: Root docs directories found!"
    echo "Documentation MUST only exist in Modules/*/docs/"
    exit 1
fi
echo "✅ Documentation structure is compliant"
```

## 📋 Implementation Checklist

- [ ] Delete `/var/www/html/_bases/base_saluteora/docs/`
- [ ] Delete `/var/www/html/_bases/base_saluteora/laravel/docs/`
- [ ] Move useful content to appropriate module docs
- [ ] Archive obsolete documentation
- [ ] Update .gitignore to prevent recreation
- [ ] Add validation to CI/CD pipeline
- [ ] Update all internal documentation links

## 🚀 Benefits Achieved

- **Zero Confusion**: Documentation location is always predictable
- **Perfect Modularity**: Each module is truly independent
- **Enhanced Maintainability**: Documentation stays current with code
- **Improved Developer Experience**: Faster navigation and discovery
- **Architectural Compliance**: Respects modular design principles

## ⚠️ Exception Rules

**NO EXCEPTIONS** - This rule is absolute and non-negotiable.

The only documentation files allowed at root level are:
- `README.md` (project overview)
- `CLAUDE.md` (AI guidelines)
- `CHANGELOG.md` (if needed)

---

**Status**: 🚨 **CRITICAL ENFORCEMENT REQUIRED**  
**Priority**: **IMMEDIATE**  
**Compliance**: **MANDATORY**