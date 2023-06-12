<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Business;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyProductListSearchRestApi\Business\CompanyProductListSearchRestApiBusinessFactory getFactory()
 */
class CompanyProductListSearchRestApiFacade extends AbstractFacade implements CompanyProductListSearchRestApiFacadeInterface
{
    /**
     * @param array<\Generated\Shared\Transfer\FilterFieldTransfer> $filterFieldTransfers
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    public function expandSearchProductListQuery(
        array $filterFieldTransfers,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): QueryJoinCollectionTransfer {
        return $this->getFactory()
            ->createSearchProductListQueryExpander()
            ->expand(
                $filterFieldTransfers,
                $queryJoinCollectionTransfer,
            );
    }
}
