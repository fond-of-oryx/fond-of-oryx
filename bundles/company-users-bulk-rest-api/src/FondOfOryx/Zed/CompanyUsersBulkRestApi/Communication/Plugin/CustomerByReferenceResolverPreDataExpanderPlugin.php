<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin;

use FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkDataExpanderPluginInterface;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface getRepository()
 */
class CustomerByReferenceResolverPreDataExpanderPlugin extends AbstractPlugin implements CompanyUsersBulkDataExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer
     */
    public function expand(CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer): CompanyUsersBulkPreparationCollectionTransfer
    {
        $customerCollection = $this->getRepository()->findCustomerByReferences($this->resolveCustomerReferences($companyUsersBulkPreparationCollectionTransfer));
        $customer = [];
        foreach ($customerCollection->getCustomers() as $customerTransfer){
            $customer[$customerTransfer->getCustomerReference()] = $customerTransfer;
        }

        foreach ($companyUsersBulkPreparationCollectionTransfer->getItems() as $preparedItem){
            $customerReference = $preparedItem->getItem()->getCustomer()->getCustomerReference();
            if (array_key_exists($customerReference, $customer)){
                $preparedItem->setCustomer($customer[$customerReference]);
            }
        }

        return $companyUsersBulkPreparationCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationTransfer
     * @return array
     */
    protected function resolveCustomerReferences(CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationTransfer): array
    {
        $customerReferences = [];
        foreach ($companyUsersBulkPreparationTransfer->getItems() as $preparedItem){
            if ($preparedItem->getCustomer() !== null){
                continue;
            }

            $customerReference = $preparedItem->getItem()->getCustomer()->getCustomerReference();
            if ($customerReference !== null && $customerReference !== ''){
                $customerReferences[] = $customerReference;
            }
        }

        return $customerReferences;
    }
}
