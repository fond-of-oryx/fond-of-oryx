# JellyfishBufferGui Extension Module
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/jellyfish-buffer-gui)

## Installation

```
composer require fond-of-oryx/jellyfish-buffer-gui
```

## Configuration

Register FondOfOryx path for Zed translations in shop config (`config/shared/default_config.php`)

```
if (file_exists(APPLICATION_VENDOR_DIR . '/fond-of-oryx')) {
    $config[TranslatorConstants::TRANSLATION_ZED_FILE_PATH_PATTERNS][] = APPLICATION_VENDOR_DIR . '/fond-of-oryx/*/data/translation/Zed/[a-z][a-z]_[A-Z][A-Z].csv';
}
```

Update translation cache `./vendor/bin/console translator:generate-cache`

Register FondOfOryx path for Zed navigation (`Pyz/Zed/ZedNavigation/ZedNavigationConfig.php`)

```
public function getNavigationSchemaPathPattern()
    {
        $navigationSchemaPathPatterns = parent::getNavigationSchemaPathPattern();

        if (file_exists(APPLICATION_VENDOR_DIR . '/fond-of-oryx')) {
            $navigationSchemaPathPatterns[] = APPLICATION_VENDOR_DIR . '/fond-of-oryx/*/src/*/Zed/*/Communication/';
        }

        return $navigationSchemaPathPatterns;
    }
```

Build Zed Navigation Cache `./vendor/bin/console navigation:build-cache`

Add Data to Zed Sales Details Page (`Pyz/Zed/Sales/SalesConfig.php`)

```
public function getSalesDetailExternalBlocksUrls()
    {
        $projectExternalBlocks = [
            'jellyfishBuffer' => 'jellyfish-buffer-gui/export/list',
            ...
        ];

        $externalBlocks = parent::getSalesDetailExternalBlocksUrls();

        return array_merge($externalBlocks, $projectExternalBlocks);
    }
```
