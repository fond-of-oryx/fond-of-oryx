<?php

namespace FondOfOryx\Service\QrCodeGenerator\Dependency\Wrapper;

use Endroid\QrCode\Writer\WriterInterface;

interface WriterCollectionInterface
{
    /**
     * @param string $name
     * @param \Endroid\QrCode\Writer\WriterInterface $writer
     *
     * @return $this
     */
    public function add(string $name, WriterInterface $writer): self;

    /**
     * @param string $name
     *
     * @return bool
     */
    public function has(string $name): bool;

    /**
     * @param string $name
     *
     * @throws \Exception
     *
     * @return \Endroid\QrCode\Writer\WriterInterface
     */
    public function get(string $name): WriterInterface;
}
