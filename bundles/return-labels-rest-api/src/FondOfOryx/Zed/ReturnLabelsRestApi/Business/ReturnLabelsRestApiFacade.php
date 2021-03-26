<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business;

use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelsRestApiTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\ReturnLabelsRestApi\Facade\ReturnLabelsRestApiBusinessFactory getFactory()
 */
class ReturnLabelsRestApiFacade extends AbstractFacade implements ReturnLabelsRestApiFacadeInterface
{
    /**
     * @param ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
     *
     * @return CompanyUnitAddressTransfer|null
     */
    public function findCompanyUnitAddress(
        ReturnLabelsRestApiTransfer $returnLabelsRestApiTransfer
    ): ?CompanyUnitAddressTransfer {
        // connect to return-label facade here

        return new CompanyUnitAddressTransfer();
    }

    /**
     * @param CompanyUnitAddressTransfer $companyUnitAddressTransfer
     *
     * @return ReturnLabelRestApiResponseTransfer
     */
    public function getReturnLabel(
        CompanyUnitAddressTransfer $companyUnitAddressTransfer
    ): ReturnLabelRestApiResponseTransfer {
        // connect to return-label facade here

        return new ReturnLabelRestApiResponseTransfer();
    }
}
