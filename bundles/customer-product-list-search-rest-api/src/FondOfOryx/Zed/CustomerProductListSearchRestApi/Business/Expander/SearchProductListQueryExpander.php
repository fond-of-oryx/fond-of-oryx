<?php

namespace FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Expander;

use FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service\CustomerProductListSearchRestApiToUtilEncodingServiceInterface;
use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Generated\Shared\Transfer\QueryJoinTransfer;
use Generated\Shared\Transfer\QueryWhereConditionTransfer;
use Orm\Zed\ProductList\Persistence\Map\SpyProductListTableMap;
use Propel\Runtime\ActiveQuery\Criteria;

class SearchProductListQueryExpander implements SearchProductListQueryExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Reader\ProductListReaderInterface
     */
    protected ProductListReaderInterface $productListReader;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service\CustomerProductListSearchRestApiToUtilEncodingServiceInterface
     */
    protected CustomerProductListSearchRestApiToUtilEncodingServiceInterface $utilEncodingService;

    /**
     * @param \FondOfOryx\Zed\CustomerProductListSearchRestApi\Business\Reader\ProductListReaderInterface $productListReader
     * @param \FondOfOryx\Zed\CustomerProductListSearchRestApi\Dependency\Service\CustomerProductListSearchRestApiToUtilEncodingServiceInterface $utilEncodingService
     */
    public function __construct(
        ProductListReaderInterface $productListReader,
        CustomerProductListSearchRestApiToUtilEncodingServiceInterface $utilEncodingService
    ) {
        $this->productListReader = $productListReader;
        $this->utilEncodingService = $utilEncodingService;
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
        $productListIds = $this->productListReader->getIdsByFilterFields($filterFieldTransfers);

        if (count($productListIds) === 0) {
            $productListIds[] = -1;
        }

        return $queryJoinCollectionTransfer->addQueryJoin(
            (new QueryJoinTransfer())
                ->addQueryWhereCondition(
                    (new QueryWhereConditionTransfer())
                        ->setColumn(SpyProductListTableMap::COL_ID_PRODUCT_LIST)
                        ->setComparison(Criteria::IN)
                        ->setValue($this->utilEncodingService->encodeJson($productListIds)),
                ),
        );
    }
}
