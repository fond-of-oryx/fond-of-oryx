<?php

namespace FondOfOryx\Service\QrCodeGenerator\Model;

use Endroid\QrCode\Writer\Result\ResultInterface;

class QrCode implements QrCodeInterface
{
    /**
     * @var \Endroid\QrCode\Writer\Result\ResultInterface
     */
    protected $result;

    /**
     * @param \Endroid\QrCode\Writer\Result\ResultInterface $result
     *
     * @return \FondOfOryx\Service\QrCodeGenerator\Model\QrCodeInterface
     */
    public function init(ResultInterface $result): QrCodeInterface
    {
        $this->result = $result;

        return $this;
    }

    /**
     * @return string
     */
    public function getMimeType(): string
    {
        return $this->result->getMimeType();
    }

    /**
     * @return string
     */
    public function getDataUri(): string
    {
        return $this->result->getDataUri();
    }

    /**
     * @return string
     */
    public function getString(): string
    {
        return $this->result->getString();
    }

    /**
     * @param string $path
     *
     * @return void
     */
    public function saveToFile(string $path): void
    {
        $this->result->saveToFile($path);
    }
}
