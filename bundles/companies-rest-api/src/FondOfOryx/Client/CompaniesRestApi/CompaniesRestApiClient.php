<?php

namespace FondOfOryx\Client\CompaniesRestApi;

use Generated\Shared\Transfer\CompanyCollectionTransfer;
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
     * @param \Generated\Shared\Transfer\CompanyCollectionTransfer $companyCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function deleteCompanies(CompanyCollectionTransfer $companyCollectionTransfer): CompanyCollectionTransfer
    {
        return $this->getFactory()->createZedCompaniesRestApiStub()->deleteCompanies($companyCollectionTransfer);
    }
}
