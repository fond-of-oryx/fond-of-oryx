<?php

namespace FondOfOryx\Client\CompaniesRestApi\Zed;

use FondOfOryx\Client\CompaniesRestApi\Dependency\Client\CompaniesRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompaniesRestApiStub implements CompaniesRestApiStubInterface
{
    /**
     * @var string
     */
    public const DELETE_COMPANY = '/companies-rest-api/gateway/delete';

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
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function deleteCompany(CompanyTransfer $companyTransfer): CompanyTransfer
    {
        /** @var \Generated\Shared\Transfer\CompanyTransfer $companyTransfer */
        $companyTransfer = $this->zedRequestClient->call(static::DELETE_COMPANY, $companyTransfer);

        return $companyTransfer;
    }
}
