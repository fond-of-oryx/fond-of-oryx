<?php

namespace FondOfOryx\Client\CompaniesRestApi\Zed;

use FondOfOryx\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyCollectionTransfer;
use Generated\Shared\Transfer\CompanyTransfer;

class CompaniesRestApiStub implements CompaniesRestApiStubInterface
{
    /**
     * @var string
     */
    public const DELETE_COMPANIES = '/campanies-rest-api/gateway/delete';

    /**
     * @var \FondOfOryx\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface
     */
    protected $zedRequestClient;

    /**
     * @param \FondOfOryx\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface $zedRequestClient
     */
    public function __construct(CompaniesRestApiToZedRequestClientInterface $zedRequestClient)
    {
        $this->zedRequestClient = $zedRequestClient;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyCollectionTransfer $companyCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function deleteCompanies(CompanyCollectionTransfer $companyCollectionTransfer): CompanyCollectionTransfer
    {
        /** @var \Generated\Shared\Transfer\CompanyCollectionTransfer $companyCollectionTransfer */
        $companyCollectionTransfer = $this->zedRequestClient->call(static::DELETE_COMPANIES, $companyCollectionTransfer);

        return $companyCollectionTransfer;
    }
}
