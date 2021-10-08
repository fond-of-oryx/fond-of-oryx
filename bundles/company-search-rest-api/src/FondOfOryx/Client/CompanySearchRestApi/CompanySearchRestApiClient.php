<?php

namespace FondOfOryx\Client\CompanySearchRestApi;

use Generated\Shared\Transfer\CompanyListTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\CompanySearchRestApi\CompanySearchRestApiFactory getFactory()
 */
class CompanySearchRestApiClient extends AbstractClient implements CompanySearchRestApiClientInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyListTransfer $companyListTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyListTransfer
     */
    public function searchCompanies(CompanyListTransfer $companyListTransfer): CompanyListTransfer
    {
        return $this->getFactory()
            ->createZedCompanySearchRestApiStub()
            ->searchCompanies($companyListTransfer);
    }
}
