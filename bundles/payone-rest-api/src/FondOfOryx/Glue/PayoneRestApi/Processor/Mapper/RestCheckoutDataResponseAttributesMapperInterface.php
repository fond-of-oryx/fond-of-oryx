<?php

namespace FondOfOryx\Glue\PayoneRestApi\Processor\Mapper;

use Generated\Shared\Transfer\RestCheckoutDataResponseAttributesTransfer;
use Generated\Shared\Transfer\RestCheckoutDataTransfer;

interface RestCheckoutDataResponseAttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestCheckoutDataTransfer $restCheckoutDataTransfer
     * @param \Generated\Shared\Transfer\RestCheckoutDataResponseAttributesTransfer $restCheckoutDataResponseAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\RestCheckoutDataResponseAttributesTransfer
     */
    public function mapRestCheckoutDataTransferToRestCheckoutDataResponseAttributesTransfer(
        RestCheckoutDataTransfer $restCheckoutDataTransfer,
        RestCheckoutDataResponseAttributesTransfer $restCheckoutDataResponseAttributesTransfer
    ): RestCheckoutDataResponseAttributesTransfer;
}
