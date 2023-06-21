<?php

namespace FondOfOryx\Client\CompaniesRestApi;

use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Client\Kernel\AbstractClient;

/**
 * @method \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiFactory getFactory()
 */
class CompaniesRestApiClient extends AbstractClient implements CompaniesRestApiClientInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function deleteCompany(CompanyTransfer $companyTransfer): CompanyTransfer
    {
        return $this->getFactory()->createZedCompaniesRestApiStub()->deleteCompany($companyTransfer);
    }
}
