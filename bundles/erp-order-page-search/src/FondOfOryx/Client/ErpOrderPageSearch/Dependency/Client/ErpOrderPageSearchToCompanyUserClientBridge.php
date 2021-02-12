<?php

namespace FondOfOryx\Client\ErpOrderPageSearch\Dependency\Client;

use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Client\CompanyUser\CompanyUserClientInterface;

class ErpOrderPageSearchToCompanyUserClientBridge implements ErpOrderPageSearchToCompanyUserClientInterface
{
    /**
     * @var \Spryker\Client\CompanyUser\CompanyUserClientInterface
     */
    protected $client;

    /**
     * @param \Spryker\Client\CompanyUser\CompanyUserClientInterface $client
     */
    public function __construct(CompanyUserClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Specification:
     * - Retrieves active company users collection by customer reference.
     * - Checks activity flag in a related company and company user.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    public function getActiveCompanyUsersByCustomerReference(
        CustomerTransfer $customerTransfer
    ): CompanyUserCollectionTransfer {
        return $this->client->getActiveCompanyUsersByCustomerReference($customerTransfer);
    }
}
