# JellyfishBuffer Extension Module
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-oryx/jellyfish-buffer)

## Installation

```
composer require fond-of-oryx/jellyfish-buffer
```

## Configuration

Register Plugin in `src/Pyz/Zed/JellyfishSalesOrder/JellyfishSalesOrderDependencyProvider.php`

```
    /**
     * @return \FondOfOryx\Zed\JellyfishSalesOrderExtension\Dependency\Plugin\JellyfishOrderBeforeExportPluginInterface[]
     */
    protected function getJellyfishOrderBeforeExportPlugins(): array
    {
        return [
            new JellyfishBufferBeforeOrderExportPlugin(),
        ];
    }
```

Register console command in `src/Pyz/Zed/Console/ConsoleDependencyProvider.php`

```
/**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Symfony\Component\Console\Command\Command[]
     */
    protected function getConsoleCommands(Container $container)
    {
        $commands = [
            ...
            new JellyfishBufferConsole(),
        ];
```
