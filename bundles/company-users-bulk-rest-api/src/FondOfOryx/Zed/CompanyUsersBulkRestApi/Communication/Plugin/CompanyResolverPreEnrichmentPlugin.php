<?php

namespace FondOfOryx\Zed\CompanyUsersBulkRestApi\Communication\Plugin;

use FondOfOryx\Zed\CompanyUsersBulkRestApiExtension\Dependency\Plugin\CompanyUsersBulkItemPreEnrichmentPluginInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\CompanyUsersBulkRestApi\Persistence\CompanyUsersBulkRestApiRepositoryInterface getRepository()
 */
class CompanyResolverPreEnrichmentPlugin extends AbstractPlugin implements CompanyUsersBulkItemPreEnrichmentPluginInterface
{
    public function preEnrichment(CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer): CompanyUsersBulkPreparationTransfer
    {
        $item = $companyUsersBulkPreparationTransfer->getItem();
        $companyData = $item->getCompany();

        $companyTransfer = $this->getCompanyFromCache($companyUsersBulkPreparationTransfer);
        if ($companyTransfer === null) {
            $companyTransfer = $this->getRepository()->findCompany($item->getCompany());
            $cache = $companyUsersBulkPreparationTransfer->getCompanyCache();
            $cache[$companyTransfer->getIdCompany()] = $companyTransfer;
            $companyUsersBulkPreparationTransfer->setCompanyCache($cache);
        }

        $companyData
            ->setCompanyId($companyTransfer->getUuid())
            ->setDebtorNumber($companyTransfer->getDebtorNumber());

        $item->setCompany($companyData);

        return $companyUsersBulkPreparationTransfer
            ->setCompany($companyTransfer)
            ->setItem($item);
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer
     * @return \Generated\Shared\Transfer\CompanyTransfer|null
     */
    protected function getCompanyFromCache(CompanyUsersBulkPreparationTransfer $companyUsersBulkPreparationTransfer): ?CompanyTransfer
    {
        $company = $companyUsersBulkPreparationTransfer->getItem()->getCompany();
        $companyCache = $companyUsersBulkPreparationTransfer->getCompanyCache();

        if (array_key_exists($company->getCompanyId(), $companyCache)) {
            return $companyCache[$company->getCompanyId()];
        }

        return null;
    }

}
