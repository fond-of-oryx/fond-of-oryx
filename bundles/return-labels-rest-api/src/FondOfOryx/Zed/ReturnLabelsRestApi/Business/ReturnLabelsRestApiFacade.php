<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use Generated\Shared\Transfer\CompanyUnitAddressResponseTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Facade\ReturnLabelsRestApiBusinessFactory getFactory()
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface getRepository()
 */
class ReturnLabelsRestApiFacade extends AbstractFacade implements ReturnLabelsRestApiFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer
     */
    public function findCompanyUnitAddressByExternalReference(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): CompanyUnitAddressResponseTransfer {
        return $this->getFactory()
            ->createCompanyUnitAddressReader()
            ->findCompanyUnitAddressByExternalReference($returnLabelsRestApiTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer
     */
    public function getReturnLabel(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): ReturnLabelRestApiResponseTransfer {
        // connect to return-label facade here

        return new ReturnLabelRestApiResponseTransfer();
    }
}
