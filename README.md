# Accounts

Accounts is a CakePHP-based accounting application that provides core financial management features, including vouchers, payments, ledger handling, company branches, and business entity data.

## Project summary

- Built on CakePHP 4.5 with modern PHP conventions.
- Implements accounting workflows for vouchers, payments, receipts, ledgers, and company hierarchy.
- Includes models, controllers, and templates for a complete financial application.

## Requirements

- PHP 8.1 or higher
- Composer
- CakePHP 4.5
- A compatible database (MySQL, PostgreSQL, SQLite, etc.)

## Installation

1. Clone the repository:
```bash
git clone https://github.com/robiulhasanphp/Accounts.git
cd Accounts
```

2. Install dependencies:
```bash
composer install
```

3. Configure the application:
- Create or update `config/app.php` or `config/app_local.php`
- Set the database connection under `Datasources.default`
- Configure any required environment values

4. Run database migrations or import the application schema as needed.

## Running the application

Use the built-in CakePHP server for local development:
```bash
bin/cake server
```

Then open `http://localhost:8765` in your browser.

## Testing

This repository includes a PHPUnit test suite under `tests/`.

Run tests with:
```bash
vendor/bin/phpunit
```

## Project structure

- `src/Controller/` — application controllers
- `src/Model/` — Table classes, entities, and business logic
- `src/Template/` — view templates for application pages
- `tests/` — unit and integration tests

## Notes

- Review and update any fixtures or test configuration before running tests.
- Ensure database credentials are set correctly for `config/app_local.php`.
- This application is intended for accounting and financial record management.
