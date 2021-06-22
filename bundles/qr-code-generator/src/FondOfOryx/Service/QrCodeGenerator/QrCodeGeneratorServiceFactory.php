<?php

namespace FondOfOryx\Service\QrCodeGenerator;

use FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\QrCodeWrapperInterface;
use FondOfOryx\Service\QrCodeGenerator\Model\QrCode;
use FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface;
use FondOfOryx\Service\QrCodeGenerator\Model\QrCodeWriter;
use FondOfOryx\Service\QrCodeGenerator\Model\QrCodeWriterInterface;
use Spryker\Service\Kernel\AbstractServiceFactory;

/**
 * @method \FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorConfig getConfig()
 */
class QrCodeGeneratorServiceFactory extends AbstractServiceFactory
{
    /**
     * @return \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeWriterInterface
     */
    public function createQrCodeWriter(): QrCodeWriterInterface
    {
        return new QrCodeWriter($this->getQrCodeWrapper(), $this->createQrCode());
    }

    /**
     * @return \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface
     */
    protected function createQrCode(): QrCodeInterface
    {
        return new QrCode();
    }

    /**
     * @return \FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper\QrCodeWrapperInterface
     */
    protected function getQrCodeWrapper(): QrCodeWrapperInterface
    {
        return $this->getProvidedDependency(QrCodeGeneratorDependencyProvider::WRAPPER_QR_CODE);
    }
}
