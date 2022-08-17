<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter;

use Generated\Shared\Transfer\VertigoPriceApiRequestTransfer;
use Generated\Shared\Transfer\VertigoPriceApiResponseTransfer;

interface VertigoPriceApiAdapterInterface
{
    /**
     * @param \Generated\Shared\Transfer\VertigoPriceApiRequestTransfer $vertigoPriceApiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\VertigoPriceApiResponseTransfer
     */
    public function sendRequest(
        VertigoPriceApiRequestTransfer $vertigoPriceApiRequestTransfer
    ): VertigoPriceApiResponseTransfer;
}
