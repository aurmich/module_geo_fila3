# Script di Seeding SaluteOra

## 📁 Struttura

Questa directory contiene script di seeding **specifici per il progetto SaluteOra**.

### ⚠️ Importante: Separazione da BashScripts Condivisi

Gli script qui contenuti sono stati spostati da `bashscripts/database/seeding/` perché:

1. **BashScripts è condivisa**: La cartella `bashscripts/` è condivisa tra migliaia di progetti diversi
2. **Specifici per SaluteOra**: Questi script contengono logica specifica per il sistema sanitario SaluteOra
3. **Manutenzione**: È più facile mantenere script specifici del progetto nella sua struttura

## 🎯 Utilizzo Raccomandato

### Opzione 1: Seeder Laravel Nativi (Raccomandato)

```bash
cd laravel

# Seeding completo del modulo
php artisan db:seed --class="Modules\SaluteOra\Database\Seeders\SaluteOraSeeder"

# Mass data seeding (migliaia di record)
php artisan db:seed --class="Modules\SaluteOra\Database\Seeders\MassDataSeeder"

# Seeder specifici
php artisan db:seed --class="Modules\SaluteOra\Database\Seeders\UserSeeder"
php artisan db:seed --class="Modules\SaluteOra\Database\Seeders\StudioSeeder"
php artisan db:seed --class="Modules\SaluteOra\Database\Seeders\AppointmentSeeder"
```

### Opzione 2: Script PHP Personalizzati (Se presenti)

```bash
cd /var/www/html/_bases/base_saluteora

# Esegui script personalizzati
php laravel/scripts/seeding/[nome-script].php
```

## 📊 Seeder Disponibili nel Sistema

### Seeder Principali
- `SaluteOraSeeder` - Seeder principale del modulo
- `MassDataSeeder` - Creazione massiva di dati per testing

### Seeder Specifici  
- `UserSeeder` - Utenti (Admin, Doctor, Patient)
- `StudioSeeder` - Studi medici
- `AppointmentSeeder` - Appuntamenti
- `ProfileSeeder` - Profili utente
- `ReportSeeder` - Report medici
- `PivotSeeder` - Relazioni pivot
- `StudiosCap66010Seeder` - Studi per CAP specifico
- `StudiosAttachDoctorCap66010Seeder` - Relazioni studio-dottore

## 🏗️ Struttura Dati Creati

### Sistema Sanitario Core
- **👨‍⚕️ Dottori**: Con specializzazioni, numeri di registrazione
- **👤 Pazienti**: Con profili demografici completi  
- **🏥 Studi Medici**: Con indirizzi e geolocalizzazione
- **📅 Appuntamenti**: Collegamenti tra pazienti e dottori

### Dati di Supporto
- **📋 Profili**: Informazioni estese utenti
- **📊 Report**: Report medici di esempio
- **🔗 Relazioni**: Pivot tables per multi-tenancy

## 🔧 Best Practice

1. **Backup Prima**: Sempre fare backup del database prima di seeding massivo
2. **Ambiente Corretto**: Eseguire solo in ambiente di sviluppo/testing
3. **Memory Limit**: Aumentare limite memoria per seeding massivo
4. **Verifica Migrazioni**: Assicurarsi che tutte le migrazioni siano eseguite

```bash
# Verifica stato migrazioni
php artisan migrate:status

# Backup database (esempio)
mysqldump -u user -p database_name > backup_$(date +%Y%m%d_%H%M%S).sql
```

## 📚 Collegamenti

- [Seeder Laravel Ufficiali](../../../Modules/SaluteOra/database/seeders/)
- [Factory Models](../../../Modules/SaluteOra/database/factories/)
- [Documentazione Modulo](../../../Modules/SaluteOra/docs/)
- [Analisi Factory](../../../Modules/SaluteOra/docs/models-factory-seeder-analysis.md)

---

**Ultimo aggiornamento**: 2025-01-06  
**Migrazione da**: `bashscripts/database/seeding/`  
**Motivazione**: Separazione script specifici progetto da bashscripts condivisi

