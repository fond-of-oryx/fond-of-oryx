<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Facade;

use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiAttributesTransfer;
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
     * @param ReturnLabelRestApiResponseTransfer $returnLabelRestApiResponseTransfer
     *
     * @return mixed
     */
    public function findCompanyUnitAddress(
        ReturnLabelsRestApiAttributesTransfer $returnLabelsRestApiAttributesTransfer
    ) {
    }
}
