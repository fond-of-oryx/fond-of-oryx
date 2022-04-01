<?php

namespace FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer;

use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface;

class GiftCardApiToApiQueryBuilderContainerBridge implements GiftCardApiToApiQueryBuilderContainerInterface
{
    /**
     * @var \Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface
     */
    protected $apiQueryBuilderContainer;

    /**
     * @param \Spryker\Zed\ApiQueryBuilder\Persistence\ApiQueryBuilderQueryContainerInterface $apiQueryBuilderContainer
     */
    public function __construct(ApiQueryBuilderQueryContainerInterface $apiQueryBuilderContainer)
    {
        $this->apiQueryBuilderContainer = $apiQueryBuilderContainer;
    }

    /**
     * @api
     *
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $query
     * @param \Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer $apiQueryBuilderQueryTransfer
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery|\Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function buildQueryFromRequest(ModelCriteria $query, ApiQueryBuilderQueryTransfer $apiQueryBuilderQueryTransfer): ModelCriteria
    {
        return $this->apiQueryBuilderContainer->buildQueryFromRequest($query, $apiQueryBuilderQueryTransfer);
    }
}
