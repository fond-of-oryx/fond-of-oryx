<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Reader;

use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

interface QuoteReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer|null
     */
    public function getByRestSplittableCheckoutRequest(
        RestSplittableCheckoutRequestTransfer $restSplittableCheckoutRequestTransfer
    ): ?QuoteTransfer;
}
