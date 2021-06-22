<?php

namespace FondOfOryx\Service\QrCodeGenerator\Model;

use Endroid\QrCode\Writer\Result\ResultInterface;

interface QrCodeInterface extends ResultInterface
{
    /**
     * @param \Endroid\QrCode\Writer\Result\ResultInterface $result
     *
     * @return $this
     */
    public function init(ResultInterface $result): self;
}
