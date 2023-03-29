<?php

namespace FondOfOryx\Client\BusinessOnBehalfRestApi;

use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiFactory getFactory()
 */
class BusinessOnBehalfRestApiClient extends AbstractClient implements BusinessOnBehalfRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer
     */
    public function setDefaultCompanyUserByRestBusinessOnBehalfRequest(
        RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
    ): RestBusinessOnBehalfResponseTransfer {
        return $this->getFactory()
            ->createBusinessOnBehalfRestApiZedStub()
            ->setDefaultCompanyUserByRestBusinessOnBehalfRequest($restBusinessOnBehalfRequestTransfer);
    }
}
