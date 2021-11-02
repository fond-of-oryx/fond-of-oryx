<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Model\Builder;

use Exception;
use Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer;

class EpcDataBuilder implements EpcDataBuilderInterface
{
    /**
     * @param \Generated\Shared\Transfer\PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer
     *
     * @throws \Exception
     *
     * @return string
     */
    public function fromTransfer(PaymentEpcQrCodeRequestTransfer $paymentEpcQrCodeRequestTransfer): string
    {
        $paymentEpcQrCodeRequestTransfer
            ->requireServiceTag()
            ->requireVersion()
            ->requireEncoding()
            ->requireType()
            ->requireBic()
            ->requireReceiverName()
            ->requireIban()
            ->requireAmount();

        $usage = $paymentEpcQrCodeRequestTransfer->getUsage() ?? '';
        $reference = $paymentEpcQrCodeRequestTransfer->getReference() ?? '';
        $purpose = $paymentEpcQrCodeRequestTransfer->getPurpose() ?? '';

        if (empty($usage) === false && empty($reference) === false) {
            throw new Exception(sprintf(
                'One of "Reference: (%s)" or "Usage: (%s)" must be null!',
                $paymentEpcQrCodeRequestTransfer->getReference(),
                $paymentEpcQrCodeRequestTransfer->getUsage(),
            ));
        }

        $dataString = $paymentEpcQrCodeRequestTransfer->getServiceTag();
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getVersion());
        $dataString = $this->appendStringAsNewLine($dataString, (string)$paymentEpcQrCodeRequestTransfer->getEncoding());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getType());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getBic());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getReceiverName());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getIban());
        $dataString = $this->appendStringAsNewLine($dataString, $paymentEpcQrCodeRequestTransfer->getAmount());
        $dataString = $this->appendStringAsNewLine($dataString, $purpose);
        $dataString = $this->appendStringAsNewLine($dataString, $reference);
        $dataString = $this->appendStringAsNewLine($dataString, $usage);

        return $this->appendStringAsNewLine($dataString, '');
    }

    /**
     * @param string $string
     * @param string $stringToAppend
     *
     * @return string
     */
    protected function appendStringAsNewLine(string $string, string $stringToAppend): string
    {
        return sprintf('%s%s%s', $string, PHP_EOL, $stringToAppend);
    }
}
