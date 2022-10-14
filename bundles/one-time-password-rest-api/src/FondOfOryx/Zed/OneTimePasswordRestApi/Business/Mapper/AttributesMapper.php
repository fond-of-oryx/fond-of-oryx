<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business\Mapper;

use Generated\Shared\Transfer\OneTimePasswordAttributesTransfer;
use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;

class AttributesMapper implements AttributesMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer
     * @return \Generated\Shared\Transfer\OneTimePasswordAttributesTransfer
     */
    public function mapRequestAttributesToTransfer(RestOneTimePasswordLoginLinkRequestAttributesTransfer $restOneTimePasswordRequestAttributesTransfer): OneTimePasswordAttributesTransfer
    {
        return (new OneTimePasswordAttributesTransfer())->fromArray($restOneTimePasswordRequestAttributesTransfer->toArray(), true);
    }
}
