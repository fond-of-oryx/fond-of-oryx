<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Communication\Controller;

use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Business\ReturnLabelsRestApiFacadeInterface getFacade()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param string $externalReference
     *
     * @return CompanyUnitAddressResponseTransfer
     */
    public function findCompanyUnitAddressByExternalReferenceAction(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): CompanyUnitAddressResponseTransfer {
        return $this->getFacade()
            ->findCompanyUnitAddressByExternalReference($returnLabelsRestApiTransfer);
    }


    /**
     * @param CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return ReturnLabelRestApiResponseTransfer
     */
    public function getReturnLabelAction(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): ReturnLabelRestApiResponseTransfer {
        return $this->getFacade()
            ->getReturnLabel($companyUnitAddressTransfer);
    }
}
