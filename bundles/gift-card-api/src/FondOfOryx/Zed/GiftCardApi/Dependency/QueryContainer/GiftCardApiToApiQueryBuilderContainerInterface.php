<?php

namespace FondOfOryx\Zed\GiftCardApi\Dependency\QueryContainer;

use Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer;
use Propel\Runtime\ActiveQuery\ModelCriteria;

interface GiftCardApiToApiQueryBuilderContainerInterface
{
    /**
     * @api
     *
     * @param \Propel\Runtime\ActiveQuery\ModelCriteria $query
     * @param \Generated\Shared\Transfer\ApiQueryBuilderQueryTransfer $apiQueryBuilderQueryTransfer
     *
     * @return \Orm\Zed\Product\Persistence\SpyProductQuery|\Propel\Runtime\ActiveQuery\ModelCriteria
     */
    public function buildQueryFromRequest(ModelCriteria $query, ApiQueryBuilderQueryTransfer $apiQueryBuilderQueryTransfer): ModelCriteria;
}
