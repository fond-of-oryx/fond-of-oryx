<?php

namespace FondOfOryx\Zed\CompanyPriceListsRestApi\Communication\Plugin\PriceListExtension;

use ArrayObject;
use FondOfOryx\Shared\CompanyPriceListsRestApi\CompanyPriceListsRestApiConstants;
use FondOfOryx\Zed\PriceListExtension\Dependency\Plugin\SearchPriceListQueryExpanderPluginInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\Company\Persistence\Map\SpyCompanyTableMap;
use Orm\Zed\PriceList\Persistence\Map\FoiPriceListTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CompanySearchPriceListQueryExpanderPlugin extends AbstractPlugin implements SearchPriceListQueryExpanderPluginInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     *
     * @return bool
     */
    public function isApplicable(array $filterFieldTransfers): bool
    {
        foreach ($filterFieldTransfers as $fieldTransfer) {
            if ($fieldTransfer->getType() === CompanyPriceListsRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID) {
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
            if ($currentFilterFieldTransfer->getType() === CompanyPriceListsRestApiConstants::FILTER_FIELD_TYPE_COMPANY_UUID) {
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
                ->setLeft([FoiPriceListTableMap::COL_ID_PRICE_LIST])
                ->setRight([SpyCompanyTableMap::COL_FK_PRICE_LIST])
                ->setWhereConditions(new ArrayObject($whereConditions)),
        );

        return $queryJoinCollectionTransfer;
    }
}
