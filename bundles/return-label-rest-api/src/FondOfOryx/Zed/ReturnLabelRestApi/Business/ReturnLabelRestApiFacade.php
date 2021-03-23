<?php

namespace FondOfOryx\Zed\ReturnLabelRestApi\Facade;

use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ReturnLabelRestApi\Facade\ReturnLabelRestApiBusinessFactory getFactory()
 */
class ReturnLabelRestApiFacade extends AbstractFacade implements ReturnLabelRestApiFacadeInterface
{
    /**
     * @param int $idCompanyUnitAddress
     *
     * @return ApiItemTransfer
     */
    public function requestReturnLabel(int $idCompanyUnitAddress): ApiItemTransfer
    {
        return $this->getFactory()
            ->createMicroServiceClient()
            ->getReturnLabel($idCompanyUnitAddress);
    }
}
