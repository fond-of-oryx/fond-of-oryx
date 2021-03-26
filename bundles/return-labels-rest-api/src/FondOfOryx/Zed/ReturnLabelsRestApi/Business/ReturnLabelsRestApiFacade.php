<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiAttributesTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Facade\ReturnLabelsRestApiBusinessFactory getFactory()
 */
class ReturnLabelsRestApiFacade extends AbstractFacade implements ReturnLabelsRestApiFacadeInterface
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

    /**
     * @param ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return mixed
     */
    public function findCompanyUnitAddress(ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer)
    {
    }
}
