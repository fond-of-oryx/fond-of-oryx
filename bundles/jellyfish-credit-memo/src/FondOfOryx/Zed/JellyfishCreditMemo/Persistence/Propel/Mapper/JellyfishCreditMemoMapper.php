<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Persistence\Propel\Mapper;

use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\CompanyTransfer;
use Generated\Shared\Transfer\SpyCompanyBusinessUnitEntityTransfer;
use Orm\Zed\Company\Persistence\SpyCompany;

class JellyfishCreditMemoMapper implements JellyfishCreditMemoMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\SpyCompanyBusinessUnitEntityTransfer $businessUnitEntityTransfer
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $businessUnitTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function mapCreditMemoEntityCollectionToCreditMemoCollectionTransfer(
        SpyCompanyBusinessUnitEntityTransfer $businessUnitEntityTransfer,
        CompanyBusinessUnitTransfer $businessUnitTransfer
    ): CompanyBusinessUnitTransfer {
        $businessUnitTransfer->fromArray($businessUnitEntityTransfer->toArray(), true);
        if (!$businessUnitTransfer->getFkParentCompanyBusinessUnit()) {
            $businessUnitTransfer->setParentCompanyBusinessUnit(null);
        }

        return $businessUnitTransfer;
    }

    /**
     * @param \Orm\Zed\Company\Persistence\SpyCompany $companyEntity
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    protected function mapCompanyEntityToCompanyTransfer(
        SpyCompany $companyEntity,
        CompanyTransfer $companyTransfer
    ): CompanyTransfer {
        return $companyTransfer->fromArray(
            $companyEntity->toArray(),
            true,
        );
    }
}
