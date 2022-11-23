<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Communication\Plugin\ProductListSearchRestApi;

use FondOfOryx\Shared\CustomerProductListSearchRestApi\CustomerProductListSearchRestApiConstants;
use FondOfOryx\Zed\ProductListSearchRestApiExtension\Dependency\Plugin\SearchQuoteQueryExpanderPluginInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListCustomerTableMap;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Propel\Runtime\ActiveQuery\Criteria;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

class CustomerSearchQuoteQueryExpanderPlugin extends AbstractPlugin implements SearchQuoteQueryExpanderPluginInterface
{
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
        $idCustomer = null;

        foreach ($filterFieldTransfers as $filterFieldTransfer) {
            if (
                $filterFieldTransfer->getType()
                !== CustomerProductListSearchRestApiConstants::FILTER_FIELD_TYPE_ID_CUSTOMER
            ) {
                continue;
            }

            $idCustomer = $filterFieldTransfer->getValue();
        }

        $whereCondition = (new QueryWhereConditionTransfer())
            ->setValue($idCustomer)
            ->setColumn(SpyProductListCustomerTableMap::COL_FK_CUSTOMER)
            ->setComparison(Criteria::EQUAL);

        return $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->setJoinType(Criteria::INNER_JOIN)
                ->setLeft([SpyProductListTableMap::COL_ID_PRODUCT_LIST])
                ->setRight([SpyProductListCustomerTableMap::COL_FK_PRODUCT_LIST])
                ->addQueryWhereCondition($whereCondition),
        );
    }
}
