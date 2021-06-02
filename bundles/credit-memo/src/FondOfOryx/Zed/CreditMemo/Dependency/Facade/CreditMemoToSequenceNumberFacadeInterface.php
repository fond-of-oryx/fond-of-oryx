<?php

namespace FondOfOryx\Zed\CreditMemo\Dependency\Facade;

use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;

interface CreditMemoToSequenceNumberFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\SequenceNumberSettingsTransfer $sequenceNumberSettingsTransfer
     *
     * @return string
     */
    public function generate(SequenceNumberSettingsTransfer $sequenceNumberSettingsTransfer): string;
}
