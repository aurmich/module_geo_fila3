# Eloquent Unit Testing – Reflection-based instantiation (no container boot)

## Problem
Directly constructing Eloquent models in unit tests triggers trait boot and container bindings (e.g., `config`), causing exceptions like:

- `BindingResolutionException: Target class [config] does not exist`
- Warnings from Eloquent trait initializers

## Rule
When testing protected/base methods (e.g., `casts()`), avoid `new Model()`. Use Reflection to:

1. Get the method via `getMethod()` and set accessible
2. Instantiate with `newInstanceWithoutConstructor()` to bypass Eloquent boot

```php
$rc = new \ReflectionClass(TestModel::class);
$method = $rc->getMethod('casts');
$method->setAccessible(true);
$instance = $rc->newInstanceWithoutConstructor();

expect($method->invoke($instance))->toBeArray();
```

## Anti-patterns
- Forcing `new Model()` in pure unit tests just to access protected logic
- Adding container bindings (e.g., `config`) only to make a unit test pass

## When to use
- Unit tests verifying contracts/metadata of models (casts, signatures)
- Not for feature/integration tests, where full boot is expected

## Real example
- Fix applied in: `Modules/SaluteMo/tests/Unit/BaseModelTest.php`

## Backlinks
- Module doc: `Modules/SaluteMo/docs/testing/eloquent-unit-tests.md`
- Windsurf rule: `.windsurf/rules/testing-eloquent-unit.md`
- Cursor rule: `.cursor/rules/testing-eloquent-unit.md`

Updated: 2025-08-25
