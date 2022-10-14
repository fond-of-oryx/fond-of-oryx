<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business\Mapper;

use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;

interface AttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer
     */
    public function mapRequestAttributesToTransfer(
        RestOneTimePasswordLoginLinkRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
    ): OneTimePasswordAttributesTransfer;
}
