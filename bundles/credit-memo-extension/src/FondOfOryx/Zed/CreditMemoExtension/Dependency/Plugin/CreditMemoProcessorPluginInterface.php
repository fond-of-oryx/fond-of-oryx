<?php

namespace FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;

interface CreditMemoProcessorPluginInterface
{
    /**
     * @var string
     */
    public const EVENT_NAME = 'check for refund';

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     * @param \Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer $statusResponse
     *
     * @return \Generated\Shared\Transfer\CreditMemoProcessorStatusTransfer|null
     */
    public function process(CreditMemoTransfer $creditMemoTransfer, CreditMemoProcessorStatusTransfer $statusResponse): ?CreditMemoProcessorStatusTransfer;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param \Generated\Shared\Transfer\CreditMemoTransfer $creditMemoTransfer
     *
     * @return bool
     */
    public function canProcess(CreditMemoTransfer $creditMemoTransfer): bool;
}
