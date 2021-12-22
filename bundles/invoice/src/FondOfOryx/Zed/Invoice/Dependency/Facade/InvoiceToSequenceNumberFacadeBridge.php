<?php

namespace FondOfOryx\Zed\Invoice\Dependency\Facade;

use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;
use Spryker\Zed\SequenceNumber\Business\SequenceNumberFacadeInterface;

class InvoiceToSequenceNumberFacadeBridge implements InvoiceToSequenceNumberFacadeInterface
{
    /**
     * @var \Spryker\Zed\SequenceNumber\Business\SequenceNumberFacadeInterface
     */
    protected $sequenceNumberFacade;

    /**
     * @param \Spryker\Zed\SequenceNumber\Business\SequenceNumberFacadeInterface $sequenceNumberFacade
     */
    public function __construct(SequenceNumberFacadeInterface $sequenceNumberFacade)
    {
        $this->sequenceNumberFacade = $sequenceNumberFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\SequenceNumberSettingsTransfer $sequenceNumberSettingsTransfer
     *
     * @return string
     */
    public function generate(SequenceNumberSettingsTransfer $sequenceNumberSettingsTransfer): string
    {
        return $this->sequenceNumberFacade->generate($sequenceNumberSettingsTransfer);
    }
}
