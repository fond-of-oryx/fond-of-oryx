<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin;

use FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkItemPreEnrichmentPluginInterface;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface getRepository()
 */
class CustomerResolverPreEnrichmentPlugin extends AbstractPlugin implements CompanyUsersBulkItemPreEnrichmentPluginInterface
{
    public function preEnrichment(CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer): CompanyUsersBulkPreparationTransfer
    {
        $item = $companyUsersBulkPreparationTransfer->getItem();
        $customerData = $item->getCustomer();

        $customerTransfer = $this->getCustomerFromCache($companyUsersBulkPreparationTransfer);
        if ($customerTransfer === null) {
            $customerTransfer = $this->getRepository()->findCustomer($item->getCustomer());
            $cache = $companyUsersBulkPreparationTransfer->getCompanyCache();
            $cache[$customerTransfer->getCustomerReference()] = $customerTransfer;
            $companyUsersBulkPreparationTransfer->setCustomerCache($cache);
        }

        $customerData
            ->setCustomerReference($customerTransfer->getCustomerReference())
            ->setEmail($customerTransfer->getEmail());

        $item->setCustomer($customerData);

        return $companyUsersBulkPreparationTransfer
            ->setCustomer($customerTransfer)
            ->setItem($item);
    }

    protected function getCustomerFromCache(CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer): ?CustomerTransfer
    {
        $customer = $companyUsersBulkPreparationTransfer->getItem()->getCustomer();
        $customerCache = $companyUsersBulkPreparationTransfer->getCustomerCache();

        if (array_key_exists($customer->getCustomerReference(), $customerCache)) {
            return $customerCache[$customer->getCustomerReference()];
        }

        return null;
    }

}
