<?php

namespace FondOfOryx\Service\QrCodeGenerator;

use FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface;
use Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer;
use Spryker\Service\Kernel\AbstractService;

/**
 * @method \FondOfOryx\Service\QrCodeGenerator\QrCodeGeneratorServiceFactory getFactory()
 */
class QrCodeGeneratorService extends AbstractService implements QrCodeGeneratorServiceInterface
{
    /**
     * @param \Generated\Shared\Transfer\QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
     *
     * @return \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface
     */
    public function createQrCode(
        QrCodeGeneratorRequestTransfer $qrCodeGeneratorRequestTransfer
    ): QrCodeInterface {
        return $this->getFactory()->createQrCodeWriter()->generateQrCode($qrCodeGeneratorRequestTransfer);
    }
}
