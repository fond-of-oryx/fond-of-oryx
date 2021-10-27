<?php

namespace FondOfOryx\Client\CompanyBusinessUnitSearchRestApi;

use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiFactory getFactory()
 */
class CompanyBusinessUnitSearchRestApiClient extends AbstractClient implements CompanyBusinessUnitSearchRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer
     */
    public function searchCompanyBusinessUnit(CompanyBusinessUnitListTransfer $companyBusinessUnitListTransfer): CompanyBusinessUnitListTransfer
    {
        return $this->getFactory()
            ->createZedCompanyBusinessUnitSearchRestApiStub()
            ->searchCompanyBusinessUnit($companyBusinessUnitListTransfer);
    }
}
