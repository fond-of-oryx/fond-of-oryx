# Thirty Five Up API
[![license](https://img.shields.io/github/license/fond-of-oryx/thirty-five-up-api.svg)](https://packagist.org/packages/fond-of-oryx/thirty-five-up-api)

## What it does

Provides API endpoints for getting and patching ThirtyFiveUp orders

## Installation

```
composer require fond-of-oryx/thirty-five-up-api
```

Register plugins in `src/Pyz/Zed/Api/ApiDependencyProvider.php`

```
    protected function getApiResourcePluginCollection(): array
    {
        return [
            ...
            new ThirtyFiveUpApiResourcePlugin(),
        ];
    }
```

```
    protected function getApiValidatorPluginCollection(): array
    {
        return [
            ...
            new ThirtyFiveUpApiValidatorPlugin(),
        ];
    }
```
