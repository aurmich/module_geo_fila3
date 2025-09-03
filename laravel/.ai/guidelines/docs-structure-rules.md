# Documentation Structure Rules

## 🚫 PROHIBITED Documentation Locations

### NEVER Create Documentation in These Locations:
1. `/var/www/html/_bases/base_saluteora/docs/` - ❌ ABSOLUTELY FORBIDDEN
2. `/var/www/html/_bases/base_saluteora/laravel/docs/` - ❌ ABSOLUTELY FORBIDDEN

## ✅ APPROVED Documentation Locations

### Module-Level Documentation (Preferred)
```
Modules/{ModuleName}/docs/
```

### Project-Level Guidelines
```
.ai/guidelines/
```

### Global Configuration Documentation
```
CLAUDE.md (project-specific rules)
```

## 🎯 Rationale

### Why These Locations Are Forbidden:
- **Module Independence**: Each module should be self-contained
- **Reusability**: Modules can be used across different projects
- **Separation of Concerns**: Project-specific vs module-specific documentation
- **Maintenance**: Easier to manage and update documentation per module

### Module Documentation Structure
```
Modules/{ModuleName}/docs/
├── README.md                 # Module overview
├── architecture/            # Architectural decisions
├── api/                     # API documentation  
├── examples/                # Usage examples
├── migration/               # Migration guides
└── optimization/            # Performance optimizations
```

## 🔧 Enforcement Rules

### 1. Documentation Creation
- ✅ **ALLOWED**: `Modules/Activity/docs/optimization/performance.md`
- ✅ **ALLOWED**: `.ai/guidelines/testing-rules.md`
- ❌ **FORBIDDEN**: `/var/www/html/_bases/base_saluteora/docs/anything.md`
- ❌ **FORBIDDEN**: `/var/www/html/_bases/base_saluteora/laravel/docs/anything.md`

### 2. Documentation Migration
If you find documentation in prohibited locations:
1. **MOVE** to appropriate module `docs/` directory
2. **ARCHIVE** historical documentation in module `docs/archive/`
3. **UPDATE** references and links
4. **VERIFY** no broken links remain

### 3. Cross-Module Documentation
For documentation spanning multiple modules:
- Use `.ai/guidelines/` for project-wide standards
- Create symlinks between module docs if needed
- Reference other modules' documentation

## 📊 Compliance Checklist

- [ ] No documentation in base `/docs/` directories
- [ ] All modules have self-contained `docs/` folders
- [ ] Project-wide guidelines in `.ai/guidelines/`
- [ ] No hardcoded project-specific references in module docs
- [ ] Documentation follows module reusability principles

## 🚨 Violation Handling

If you accidentally create documentation in prohibited locations:
1. **IMMEDIATELY** move to correct location
2. **UPDATE** this guidelines file with lesson learned
3. **VERIFY** no other violations exist
4. **DOCUMENT** the correction process

## 📝 Examples

### Correct Module Documentation
```bash
# ✅ CORRECT
Modules/Geo/docs/address-implementation.md
Modules/Activity/docs/event-sourcing.md
.ai/guidelines/testing-best-practices.md
```

### Incorrect Documentation  
```bash
# ❌ INCORRECT
/var/www/html/_bases/base_saluteora/docs/geo.md
/var/www/html/_bases/base_saluteora/laravel/docs/activity.md
```
