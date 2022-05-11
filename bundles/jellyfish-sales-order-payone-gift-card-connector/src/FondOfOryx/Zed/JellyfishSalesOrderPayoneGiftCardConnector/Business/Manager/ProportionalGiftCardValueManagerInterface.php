<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderPayoneGiftCardConnector\Business\Manager;

use Generated\Shared\Transfer\JellyfishOrderTransfer;

interface ProportionalGiftCardValueManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return void
     */
    public function persistProportionalGiftCardValuesFromExport(JellyfishOrderTransfer $jellyfishOrderTransfer): void;
}
