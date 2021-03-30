<?php

namespace FondOfOryx\Client\ReturnLabelsRestApi\Dependency\Client;

use FondOfSpryker\Client\CompanyUserReference\CompanyUserReferenceClientInterface;
use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;

class ReturnLabelsRestApiToCompanyUserReferenceClientBridge implements ReturnLabelsRestApiToCompanyUserReferenceClientInterface
{
    /**
     * @var \FondOfSpryker\Client\CompanyUserReference\CompanyUserReferenceClientInterface
     */
    protected $companyUserReferenceClient;

    /**
     * @param \FondOfSpryker\Client\CompanyUserReference\CompanyUserReferenceClientInterface $companyUserReferenceClient
     */
    public function __construct(CompanyUserReferenceClientInterface $companyUserReferenceClient)
    {
        $this->companyUserReferenceClient = $companyUserReferenceClient;
    }

    /**
     * Specifications:
     *  - Finds company user by reference.
     *  - Returns company user response transfer.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    public function findCompanyUserByCompanyUserReference(
        CompanyUserTransfer $companyUserTransfer
    ): CompanyUserResponseTransfer {
        return $this->companyUserReferenceClient->findCompanyUserByCompanyUserReference($companyUserTransfer);
    }
}
