<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer;

interface RestErrorMessageMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestSplittableCheckoutErrorTransfer $restSplittableCheckoutErrorTransfer
     * @param string $localeName
     *
     * @return \Generated\Shared\Transfer\RestErrorMessageTransfer
     */
    public function fromRestSplittableCheckoutErrorAndLocaleName(
        RestSplittableCheckoutErrorTransfer $restSplittableCheckoutErrorTransfer,
        string $localeName
    ): RestErrorMessageTransfer;
}
