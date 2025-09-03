# Module Independence Guidelines

## CRITICAL RULE: Modules Must Be Project-Agnostic

**FONDAMENTALE**: I moduli condivisi DEVONO essere completamente indipendenti dal progetto specifico. Mai includere riferimenti a nomi di progetti, configurazioni specifiche, o logiche business legate a un singolo progetto.

## Rules for Shared Modules

### 1. No Project-Specific References

```php
// ❌ SBAGLIATO - Riferimento a progetto specifico
'content' => 'Benvenuto su SaluteOra!'

// ✅ CORRETTO - Riferimento generico/configurabile  
'content' => 'Benvenuto su ' . config('app.name', 'Our Platform')
'content' => 'Benvenuto su {{app_name}}'
```

### 2. Configuration-Driven Content

```php
// Usare sempre configurazioni invece di valori fissi
return [
    'welcome_message' => config('notify.welcome_message', 'Welcome to our platform'),
    'company_name' => config('app.name', 'Our Company'),
];
```

### 3. Template Variables Instead of Hardcoded Values

```php
// ❌ SBAGLIATO
'content' => 'Grazie per esserti registrato su SaluteOra'

// ✅ CORRETTO
'content' => 'Grazie per esserti registrato su {{company_name}}'
'content' => 'Thank you for joining {{app_name}}'
```

### 4. Language Files for Localization

```php
// Usare sempre traduzioni invece di stringhe hardcoded
trans('notify::messages.welcome_message', ['app_name' => config('app.name')])
```

## Module Configuration Structure

### 1. Default Configuration

```php
// config/notify.php
return [
    'messages' => [
        'welcome' => 'Welcome to :app_name',
        'registration_success' => 'Thank you for registering with :company',
    ],
    'placeholders' => [
        'app_name' => config('app.name', 'Our Platform'),
        'company' => config('app.company', 'Our Company'),
    ],
];
```

### 2. Language Files Structure

```php
// resources/lang/en/messages.php
return [
    'welcome' => 'Welcome to :app_name',
    'registration' => 'Thank you for registering with :company',
];

// resources/lang/it/messages.php
return [
    'welcome' => 'Benvenuto su :app_name', 
    'registration' => 'Grazie per esserti registrato su :company',
];
```

## Testing Guidelines for Shared Modules

### 1. Generic Test Data

```php
// ❌ SBAGLIATO - Dati specifici di progetto
it('sends welcome email for SaluteOra', function () {
    $content = 'Benvenuto su SaluteOra!';
});

// ✅ CORRETTO - Dati generici
it('sends welcome email with app name', function () {
    $content = 'Benvenuto su ' . config('app.name', 'Test Platform');
});
```

### 2. Configuration-Based Assertions

```php
it('uses configured app name in notifications', function () {
    config(['app.name' => 'Test Platform']);
    
    $notification = createNotification();
    
    expect($notification->content)->toContain('Test Platform');
});
```

### 3. Placeholder Testing

```php
it('replaces placeholders with configured values', function () {
    config(['app.name' => 'MedicalApp']);
    
    $template = 'Welcome to {{app_name}}';
    $content = str_replace('{{app_name}}', config('app.name'), $template);
    
    expect($content)->toBe('Welcome to MedicalApp');
});
```

## Common Patterns to Avoid

### 1. Hardcoded Project Names

```php
// ❌ DA EVITARE
'SaluteOra', 'MyClinic', 'HealthPortal', 'MedApp'

// ✅ DA USARE  
config('app.name'), '{{app_name}}', trans('app.name')
```

### 2. Project-Specific Business Logic

```php
// ❌ DA EVITARE
if ($user->isSaluteOraPatient()) { ... }

// ✅ DA USARE
if ($user->hasRole('patient')) { ... }
if (config('app.features.patient_portal')) { ... }
```

### 3. Environment-Specific Configuration

```php
// ❌ DA EVITARE
if (app()->environment('saluteora-production')) { ... }

// ✅ DA USARE
if (config('notify.production_mode')) { ... }
```

## Configuration Best Practices

### 1. Environment Variables

```bash
# .env
APP_NAME="Generic App"
APP_COMPANY="Generic Company"

# .env.testing  
APP_NAME="Test Platform"
APP_COMPANY="Test Company"
```

### 2. Module Configuration Defaults

```php
// Modules/Notify/config/config.php
return [
    'messages' => [
        'welcome' => env('NOTIFY_WELCOME_MESSAGE', 'Welcome to :app_name'),
        'registration' => env('NOTIFY_REGISTRATION_MESSAGE', 'Thank you for joining :company'),
    ],
];
```

### 3. Service Provider Configuration

```php
public function boot()
{
    $this->app->bind('notify.messages', function () {
        return [
            'welcome' => config('notify.messages.welcome', 'Welcome to :app_name'),
            'registration' => config('notify.messages.registration', 'Thank you for registering'),
        ];
    });
}
```

## Validation Rules for Module Independence

### 1. Pre-Commit Checks

```bash
# Script per verificare riferimenti a progetti specifici
grep -r "SaluteOra\|MyClinic\|HealthPortal" Modules/Notify/ --include="*.php"

# Verifica configurazioni invece di valori hardcoded
grep -r "config\(.*app\.name" Modules/Notify/ --include="*.php"
```

### 2. Automated Testing

```php
it('has no project-specific hardcoded values', function () {
    $forbiddenNames = ['SaluteOra', 'MyClinic', 'HealthPortal', 'MedApp'];
    
    foreach ($forbiddenNames as $name) {
        $this->assertFalse(
            Str::contains(file_get_contents(__DIR__.'/../../'), $name),
            "Found forbidden project name: {$name}"
        );
    }
});
```

### 3. Code Review Checklist

- [ ] Nessun nome di progetto hardcoded
- [ ] Tutti i test usano dati generici
- [ ] Configurazioni invece di valori fissi
- [ ] Placeholders invece di stringhe specifiche
- [ ] Traduzioni invece di testo hardcoded
- [ ] Logica business generica e riutilizzabile

## Emergency Fix Procedures

### 1. Find and Replace Project References

```bash
# Trova tutti i riferimenti a progetti specifici
find Modules/Notify/ -name "*.php" -exec grep -l "SaluteOra" {} \;

# Sostituisci con configurazioni
sed -i 's/SaluteOra/config("app.name")/g' Modules/Notify/**/*.php
```

### 2. Configuration Migration

```php
// Prima: valore hardcoded
'content' => 'Benvenuto su SaluteOra'

// Dopo: configurazione
'content' => 'Benvenuto su ' . config('app.name', 'Our Platform')
```

### 3. Template Variable Conversion

```php
// Prima: stringa specifica
'Ciao {{user_name}}, benvenuto su SaluteOra!'

// Dopo: placeholder generico  
'Ciao {{user_name}}, benvenuto su {{app_name}}!'
```

## Summary of Critical Rules

1. **MAI** usare nomi di progetti specifici in moduli condivisi
2. **SEMPRE** usare configurazioni, traduzioni, o placeholders
3. **VERIFICARE** che tutti i test usino dati generici
4. **DOCUMENTARE** le dipendenze di configurazione
5. **TESTARE** l'indipendenza del modulo regolarmente

## Module Independence Checklist

- [ ] Nessun riferimento hardcoded a progetti specifici
- [ ] Tutto il testo configurabile attraverso config/traduzioni
- [ ] Placeholders per tutti i nomi specifici
- [ ] Test utilizzano dati generici e configurabili
- [ ] Documentazione delle dipendenze di configurazione
- [ ] Script di verifica pre-commit implementati
- [ ] Procedure di emergenza per fix documentate