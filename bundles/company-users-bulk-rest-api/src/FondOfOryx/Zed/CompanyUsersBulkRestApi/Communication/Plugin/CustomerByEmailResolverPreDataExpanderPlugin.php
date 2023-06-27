<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin;

use FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkDataExpanderPluginInterface;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface getRepository()
 */
class CustomerByEmailResolverPreDataExpanderPlugin extends AbstractPlugin implements CompanyUsersBulkDataExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer
     */
    public function expand(
        CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
    ): CompanyUsersBulkPreparationCollectionTransfer {
        $customerCollection = $this->getRepository()->findCustomerByEmail($this->resolveCustomerEmailAddresses($companyUsersBulkPreparationCollectionTransfer));
        $customer = [];
        foreach ($customerCollection->getCustomers() as $customerTransfer) {
            $customer[$customerTransfer->getEmail()] = $customerTransfer;
        }

        foreach ($companyUsersBulkPreparationCollectionTransfer->getItems() as $preparedItem) {
            $email = $preparedItem->getItem()->getCustomer()->getEmail();
            if (array_key_exists($email, $customer)) {
                $preparedItem->setCustomer($customer[$email]);
            }
        }

        return $companyUsersBulkPreparationCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationTransfer
     *
     * @return array
     */
    protected function resolveCustomerEmailAddresses(CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationTransfer): array
    {
        $customerEmailAddresses = [];
        foreach ($companyUsersBulkPreparationTransfer->getItems() as $preparedItem) {
            if ($preparedItem->getCustomer() !== null) {
                continue;
            }

            $customerEmail = $preparedItem->getItem()->getCustomer()->getEmail();
            if ($customerEmail !== null && $customerEmail !== '') {
                $customerEmailAddresses[] = $customerEmail;
            }
        }

        return $customerEmailAddresses;
    }
}
