<?php

namespace FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyTypeProductListSearchRestApi\Business\CompanyTypeProductListSearchRestApiBusinessFactory getFactory()
 */
class CompanyTypeProductListSearchRestApiFacade extends AbstractFacade implements CompanyTypeProductListSearchRestApiFacadeInterface
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
