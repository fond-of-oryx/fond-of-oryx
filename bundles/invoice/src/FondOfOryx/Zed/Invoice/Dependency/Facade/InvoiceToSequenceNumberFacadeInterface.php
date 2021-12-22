<?php

namespace FondOfOryx\Zed\Invoice\Dependency\Facade;

use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;

interface InvoiceToSequenceNumberFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\SequenceNumberSettingsTransfer $sequenceNumberSettingsTransfer
     *
     * @return string
     */
    public function generate(SequenceNumberSettingsTransfer $sequenceNumberSettingsTransfer): string;
}
