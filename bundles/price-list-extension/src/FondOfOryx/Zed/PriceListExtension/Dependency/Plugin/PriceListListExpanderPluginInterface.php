<?php

namespace FondOfOryx\Zed\PriceListExtension\Dependency\Plugin;

use Generated\Shared\Transfer\PriceListListTransfer;

interface PriceListListExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\PriceListListTransfer $priceListListTransfer
     *
     * @return \Generated\Shared\Transfer\PriceListListTransfer
     */
    public function expand(PriceListListTransfer $priceListListTransfer): PriceListListTransfer;
}
