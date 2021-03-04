<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Persistence;

use Generated\Shared\Transfer\FilterTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchPersistenceFactory getFactory()
 */
class ErpOrderPageSearchRepository extends AbstractRepository implements ErpOrderPageSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param int[] $erpOrderIds
     *
     * @return \Generated\Shared\Transfer\FooErpOrderPageSearchEntityTransfer[]
     */
    public function findFilteredErpOrderPageSearchEntities(
        FilterTransfer $filterTransfer,
        array $erpOrderIds = []
    ): array {
        $fooErpOrderPageSearchQuery = $this->getFactory()
            ->getErpOrderPageSearchQuery();

        if (!empty($erpOrderIds)) {
            $fooErpOrderPageSearchQuery->filterByFkErpOrder_In(
                $erpOrderIds
            );
        }

        return $this->buildQueryFromCriteria(
            $fooErpOrderPageSearchQuery,
            $filterTransfer
        )->find();
    }
}
