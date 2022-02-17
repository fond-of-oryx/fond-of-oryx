<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence;

use Generated\Shared\Transfer\FilterTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchPersistenceFactory getFactory()
 */
class ErpDeliveryNotePageSearchRepository extends AbstractRepository implements ErpDeliveryNotePageSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array<int> $erpDeliveryNoteIds
     *
     * @return array<\Generated\Shared\Transfer\FooErpDeliveryNotePageSearchEntityTransfer>
     */
    public function findFilteredErpDeliveryNotePageSearchEntities(
        FilterTransfer $filterTransfer,
        array $erpDeliveryNoteIds = []
    ): array {
        $fooErpDeliveryNotePageSearchQuery = $this->getFactory()
            ->getErpDeliveryNotePageSearchQuery();

        if (count($erpDeliveryNoteIds) > 0) {
            $fooErpDeliveryNotePageSearchQuery->filterByFkErpDeliveryNote_In(
                $erpDeliveryNoteIds,
            );
        }

        return $this->buildQueryFromCriteria(
            $fooErpDeliveryNotePageSearchQuery,
            $filterTransfer,
        )->find();
    }
}
