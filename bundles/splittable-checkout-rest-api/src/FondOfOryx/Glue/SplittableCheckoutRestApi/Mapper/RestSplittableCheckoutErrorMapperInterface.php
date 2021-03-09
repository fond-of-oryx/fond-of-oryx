<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Mapper;

use Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;

interface RestSplittableCheckoutErrorMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer $restSplittableCheckoutErrorTransfer
     * @param \Generated\Shared\Transfer\RestErrorMessageTransfer $restErrorMessageTransfer
     * @param string $locale
     *
     * @return \Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function mapLocalizedRestSplittableCheckoutErrorTransferToRestErrorTransfer(
        RestSplittableCheckoutErrorTransfer $restSplittableCheckoutErrorTransfer,
        RestErrorMessageTransfer $restErrorMessageTransfer,
        string $locale
    ): RestErrorMessageTransfer;
}
