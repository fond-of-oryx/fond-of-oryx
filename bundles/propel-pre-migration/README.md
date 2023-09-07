# Propel Pre Migration
[![CI](https://github.com/fond-of-oryx/propel-pre-migration/actions/workflows/main.yml/badge.svg)](https://github.com/fond-of-oryx/propel-pre-migration/actions/workflows/main.yml)
[![license](https://img.shields.io/github/license/fond-of-oryx/propel-pre-migration.svg)](https://packagist.org/packages/fond-of-oryx/propel-pre-migration)

## Installation
```
composer require fond-of-oryx/propel-pre-migration
```

## Configuration

Register `PropelPreMigrationConsole` in `Pyz\Zed\Console\ConsoleDependencyProvider`

## Usage

The default command is `./vendor/bin/console propel-pre-migrate:migrate`. On usage the command will check `data/PreMigrations` directory for *.sql files. Those files will be filtered for files with following naming `#\d{4}\d{1,2}\d{1,2}_\d{1,3}.sql$# example: 20230908_01.sql` and execute the filtered files. The filtering for name pattern could be overwritten in config with (`GLOB_SQL_FILE_PATTERN_DEFAULT`)

The file name of successfuly migrated files will be saved to table `foo_propel_pre_migration` in db. Files listed in this table will be ignored.

You can also execute single / specific files by name
`./vendor/bin/console propel-pre-migrate:migrate -f file1.sql` or `./vendor/bin/console propel-pre-migrate:migrate -f file1.sql,file2.sql,..fileN.sql`
