<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Communication\Plugin\CompanyUsersBulkRestApi;

use FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkDataExpanderPluginInterface;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApiBusinessCentralConnector\Persistence\CompanyUsersBulkRestApiBusinessCentralConnectorRepositoryInterface getRepository()
 */
class CompanyDebtorNumberResolverPreDataExpanderPlugin extends AbstractPlugin implements CompanyUsersBulkDataExpanderPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer
     */
    public function expand(
        CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationCollectionTransfer
    ): CompanyUsersBulkPreparationCollectionTransfer {
        $companyCollection = $this->getRepository()->findCompaniesByDebtorNumbers($this->resolveDebtorNumber($companyUsersBulkPreparationCollectionTransfer));
        $companies = [];
        foreach ($companyCollection->getCompanies() as $companyTransfer) {
            $companies[$companyTransfer->getDebtorNumber()] = $companyTransfer;
        }

        foreach ($companyUsersBulkPreparationCollectionTransfer->getItems() as $preparedItem) {
            if ($preparedItem->getCompany() !== null) {
                continue;
            }

            $debtorNumber = $preparedItem->getItem()->getCompany()->getDebtorNumber();
            if (array_key_exists($debtorNumber, $companies)) {
                $preparedItem->setCompany($companies[$debtorNumber]);
            }
        }

        return $companyUsersBulkPreparationCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationTransfer
     *
     * @return array
     */
    protected function resolveDebtorNumber(CompanyUsersBulkPreparationCollectionTransfer $companyUsersBulkPreparationTransfer): array
    {
        $debtorNumbers = [];
        foreach ($companyUsersBulkPreparationTransfer->getItems() as $preparedItem) {
            if ($preparedItem->getCompany() !== null) {
                continue;
            }
            $debtorNumber = $preparedItem->getItem()->getCompany()->getDebtorNumber();
            if ($debtorNumber !== null && $debtorNumber !== '') {
                $debtorNumbers[] = $debtorNumber;
            }
        }

        return $debtorNumbers;
    }
}
