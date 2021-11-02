<?php

namespace FondOfOryx\Service\QrCodeGenerator;

use FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\QrCodeWrapper;
use FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\WriterCollection;
use FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\WriterCollectionInterface;
use Spryker\Service\Kernel\AbstractBundleDependencyProvider;
use Spryker\Service\Kernel\Container;

/**
 * @method \FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorConfig getConfig()
 */
class QrCodeGeneratorDependencyProvider extends AbstractBundleDependencyProvider
{
    /**
     * @var string
     */
    public const WRAPPER_QR_CODE = 'WRAPPER_QR_CODE';

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    public function provideServiceDependencies(Container $container)
    {
        $container = $this->addQrCodeWrapper($container);

        return $container;
    }

    /**
     * @param \Spryker\Service\Kernel\Container $container
     *
     * @return \Spryker\Service\Kernel\Container
     */
    protected function addQrCodeWrapper(Container $container): Container
    {
        $self = $this;
        $container[static::WRAPPER_QR_CODE] = static function () use ($self) {
            return new QrCodeWrapper($self->createWriterCollection(), $self->getConfig());
        };

        return $container;
    }

    /**
     * @return \FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\WriterCollectionInterface
     */
    protected function createWriterCollection(): WriterCollectionInterface
    {
        return new WriterCollection($this->getQrCodeWriterWriter());
    }

    /**
     * @return array<\Endroid\QrCode\Writer\WriterInterface>
     */
    protected function getQrCodeWriterWriter(): array
    {
        return [];
    }
}
