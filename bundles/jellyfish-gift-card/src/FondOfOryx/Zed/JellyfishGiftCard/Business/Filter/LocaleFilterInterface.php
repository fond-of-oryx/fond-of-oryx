<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Filter;

use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\OrderTransfer;

interface LocaleFilterInterface
{
    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\LocaleTransfer
     */
    public function fromOrder(OrderTransfer $orderTransfer): LocaleTransfer;
}
