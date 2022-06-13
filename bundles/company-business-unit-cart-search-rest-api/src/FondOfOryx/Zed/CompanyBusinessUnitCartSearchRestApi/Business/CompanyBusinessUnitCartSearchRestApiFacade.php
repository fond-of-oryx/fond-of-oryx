<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business;

use Generated\Shared\Transfer\QueryJoinCollectionTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\CompanyBusinessUnitCartSearchRestApiBusinessFactory getFactory()
 */
class CompanyBusinessUnitCartSearchRestApiFacade extends AbstractFacade implements CompanyBusinessUnitCartSearchRestApiFacadeInterface
{
    /**
     * {@inheritDoc}
     *
     * @api
     *
     * @param array $filterFieldTransfers
     * @param \Generated\Shared\Transfer\QueryJoinCollectionTransfer $queryJoinCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\QueryJoinCollectionTransfer
     */
    public function expandQueryJoinCollection(
        array $filterFieldTransfers,
        QueryJoinCollectionTransfer $queryJoinCollectionTransfer
    ): QueryJoinCollectionTransfer {
        return $this->getFactory()
            ->createQueryJoinCollectionExpander()
            ->expand(
                $filterFieldTransfers,
                $queryJoinCollectionTransfer,
            );
    }
}
