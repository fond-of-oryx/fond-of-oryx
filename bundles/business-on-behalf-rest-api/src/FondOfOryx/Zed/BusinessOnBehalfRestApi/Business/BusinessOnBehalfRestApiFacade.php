<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business;

use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\BusinessOnBehalfRestApiBusinessFactory getFactory()
 */
class BusinessOnBehalfRestApiFacade extends AbstractFacade implements BusinessOnBehalfRestApiFacadeInterface
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
            ->createCompanyUserWriter()
            ->setDefaultByRestBusinessOnBehalfRequest($restBusinessOnBehalfRequestTransfer);
    }
}
