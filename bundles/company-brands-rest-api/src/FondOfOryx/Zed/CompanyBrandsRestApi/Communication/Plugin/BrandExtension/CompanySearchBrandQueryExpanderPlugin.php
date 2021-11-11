<?php

namespace FondOfOryx\Zed\CompanyBrandsRestApi\Communication\Plugin\BrandExtension;

use ArrayObject;
use FondOfOryx\Shared\CompanyBrandsRestApi\CompanyBrandsRestApiConstants;
use FondOfSpryker\Zed\BrandExtension\Dependency\Plugin\SearchBrandQueryExpanderPluginInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\Brand\Persistence\Map\FosBrandTableMap;
use Orm\Zed\BrandCompany\Persistence\Map\FosBrandCompanyTableMap;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CompanySearchBrandQueryExpanderPlugin extends AbstractPlugin implements SearchBrandQueryExpanderPluginInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return bool
     */
    public function isApplicable(array $filterFieldTransfers): bool
    {
        foreach ($filterFieldTransfers as $fieldTransfer) {
            if ($fieldTransfer->getType() === CompanyBrandsRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    public function expand(
        array $filterFieldTransfers,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): QueryJoinCollectionTransfer {
        $filterFieldTransfer = null;

        foreach ($filterFieldTransfers as $currentFilterFieldTransfer) {
            if ($currentFilterFieldTransfer->getType() === CompanyBrandsRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID) {
                $filterFieldTransfer = $currentFilterFieldTransfer;

                break;
            }
        }

        if ($filterFieldTransfer === null || $filterFieldTransfer->getValue() === null) {
            return $queryJoinCollectionTransfer;
        }

        $whereConditions = [
            (new QueryWhereConditionTransfer())
                ->setValue($filterFieldTransfer->getValue())
                ->setColumn(SpyCompanyTableMap::COL_UUID)
                ->setComparison(Criteria::EQUAL),
        ];

        $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([FosBrandTableMap::COL_ID_BRAND])
                ->setRight([FosBrandCompanyTableMap::COL_FK_BRAND]),
        );

        $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([FosBrandCompanyTableMap::COL_FK_COMPANY])
                ->setRight([SpyCompanyTableMap::COL_ID_COMPANY])
                ->setWhereConditions(new ArrayObject($whereConditions)),
        );

        return $queryJoinCollectionTransfer;
    }
}
