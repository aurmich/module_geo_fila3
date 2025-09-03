# 🚨 CRITICAL RULE: BaseModel Inheritance Violations

## ❌ ABSOLUTE PROHIBITION

**NEVER ADD THESE TO MODELS EXTENDING BaseModel:**

```php
// ❌ FORBIDDEN - BaseModel already has these
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SomeModel extends BaseModel 
{
    use HasFactory; // ❌ DUPLICATE - BaseModel already has this
    
    protected static function newFactory() // ❌ DUPLICATE - BaseModel already has this
    {
        return SomeModelFactory::new();
    }
}
```

## ✅ CORRECT PATTERN

```php
// ✅ CORRECT - Clean, no duplications
class SomeModel extends BaseModel 
{
    protected $fillable = ['name', 'description'];
    
    // BaseModel already provides:
    // - HasFactory trait
    // - newFactory() method via GetFactoryAction
    // - Updater trait
    // - Proper casts() method
    // - Standard timestamps and connection
}
```

## 🎯 Critical Understanding Required

### BaseModel Provides Everything
BaseModel (in `Modules/Xot/Models/BaseModel.php`) already includes:

1. **HasFactory trait** (line 20)
2. **newFactory() method** (lines 60-64) using GetFactoryAction
3. **Updater trait** (line 24)
4. **Standard casts()** method (lines 67-78)
5. **Database connection** configuration
6. **Fillable defaults** and standard properties

### What Models Should Contain
Models extending BaseModel should ONLY contain:

```php
class ExampleModel extends BaseModel
{
    /** @var list<string> */
    protected $fillable = [
        'specific_field_1',
        'specific_field_2',
    ];
    
    // Relationships
    public function someRelation(): BelongsTo
    {
        return $this->belongsTo(RelatedModel::class);
    }
    
    // Business methods (if needed)
    public function businessLogicMethod(): string
    {
        return $this->someField . ' processed';
    }
}
```

## 🔧 IMMEDIATE CORRECTIONS NEEDED

### Scan ALL Models
```bash
# Find all models with forbidden duplications
grep -r "use HasFactory" Modules/*/app/Models/ --include="*.php"
grep -r "newFactory()" Modules/*/app/Models/ --include="*.php"
```

### Fix Pattern
```php
// Before (WRONG)
class County extends BaseModel
{
    use HasFactory; // ❌ Remove this
    
    protected static function newFactory() // ❌ Remove this entire method
    {
        return CountyFactory::new();
    }
    
    protected $fillable = ['name'];
}

// After (CORRECT)
class County extends BaseModel
{
    protected $fillable = ['name'];
}
```

## 🚨 WHY THIS IS CRITICAL

### 1. **DRY Violation**
- Duplicating code that already exists in BaseModel
- Creates maintenance nightmares
- Causes confusion about source of truth

### 2. **Architecture Violation**
- BaseModel is designed to provide common functionality
- Models should extend, not duplicate functionality
- Breaks inheritance chain logic

### 3. **Factory Pattern Breaking**
- BaseModel uses GetFactoryAction for dynamic factory resolution
- Overriding breaks the unified factory system
- Creates inconsistent behavior across modules

### 4. **Performance Impact**
- Unnecessary trait loading
- Duplicate method resolution
- Memory overhead from redundant code

## 📋 ENFORCEMENT CHECKLIST

Before committing any model:
- [ ] Model extends BaseModel correctly
- [ ] NO `use HasFactory` in model
- [ ] NO `newFactory()` method in model  
- [ ] NO `use Updater` in model
- [ ] NO duplicate `casts()` method
- [ ] Only model-specific fillable, relationships, and business logic

## 🔍 AUTOMATED DETECTION

### Pre-commit Hook
```bash
#!/bin/bash
# Check for BaseModel inheritance violations

violations=$(grep -r "use HasFactory" Modules/*/app/Models/ --include="*.php" | grep -v BaseModel.php)
if [ ! -z "$violations" ]; then
    echo "❌ CRITICAL: Found HasFactory in models extending BaseModel:"
    echo "$violations"
    exit 1
fi

violations=$(grep -r "protected static function newFactory" Modules/*/app/Models/ --include="*.php" | grep -v BaseModel.php)
if [ ! -z "$violations" ]; then
    echo "❌ CRITICAL: Found newFactory() in models extending BaseModel:"
    echo "$violations"
    exit 1
fi
```

## 🏗️ ARCHITECTURAL PRINCIPLE

**BaseModel is the SINGLE SOURCE OF TRUTH** for:
- Factory patterns
- Update tracking
- Database connections
- Standard casts
- Common model behavior

Models extending BaseModel should be **LEAN and FOCUSED** on:
- Specific fillable fields
- Business relationships  
- Domain-specific methods
- Model-specific behavior

## ⚠️ ZERO TOLERANCE POLICY

This rule has **ZERO EXCEPTIONS**. Any model extending BaseModel that includes:
- `use HasFactory`
- `newFactory()` method
- `use Updater`
- Duplicate `casts()` method

Is a **CRITICAL ARCHITECTURAL VIOLATION** that must be fixed immediately.

---

**Status**: 🚨 **CRITICAL ENFORCEMENT REQUIRED**  
**Priority**: **IMMEDIATE**  
**Tolerance**: **ZERO EXCEPTIONS**