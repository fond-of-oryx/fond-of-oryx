<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Processor;

use ArrayIterator;
use FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface;
use Generated\Shared\Transfer\CreditMemoProcessorResponseCollectionTransfer;

interface CreditMemoProcessorInterface
{
    /**
     * @return \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface[]
     */
    public function getProcessor(): array;

    /**
     * @param string $processorName
     *
     * @return \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface
     */
    public function get(string $processorName): CreditMemoProcessorPluginInterface;

    /**
     * @param string[] $processorPluginNames
     * @param array $ids
     *
     * @return \Generated\Shared\Transfer\CreditMemoProcessorResponseCollectionTransfer
     */
    public function process(array $processorPluginNames, array $ids): CreditMemoProcessorResponseCollectionTransfer;

    /**
     * @param \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface[] $processor
     *
     * @return $this
     */
    public function setProcessor(array $processor): self;

    /**
     * @param \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoProcessorPluginInterface $processorPlugin
     *
     * @return $this
     */
    public function addProcessor(CreditMemoProcessorPluginInterface $processorPlugin): self;

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @return \ArrayIterator
     */
    public function getIterator(): ArrayIterator;
}
