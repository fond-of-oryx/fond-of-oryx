<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Communication\Controller;

use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Spryker\Zed\Kernel\Communication\Controller\AbstractGatewayController;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitAddressSearchRestApi\Persistence\CompanyBusinessUnitAddressSearchRestApiRepository getRepository()
 */
class GatewayController extends AbstractGatewayController
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer
     */
    public function searchCompanyBusinessUnitAddressAction(
        CompanyBusinessUnitAddressListTransfer $companyBusinessUnitAddressListTransfer
    ): CompanyBusinessUnitAddressListTransfer {
        return $this->getRepository()->searchCompanyBusinessUnitAddress($companyBusinessUnitAddressListTransfer);
    }
}
