<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Persistence;

use Generated\Shared\Transfer\FilterTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchPersistenceFactory getFactory()
 */
class ErpInvoicePageSearchRepository extends AbstractRepository implements ErpInvoicePageSearchRepositoryInterface
{
    /**
     * @param \Generated\Shared\Transfer\FilterTransfer $filterTransfer
     * @param array<int> $erpInvoiceIds
     *
     * @return array<\Generated\Shared\Transfer\FooErpInvoicePageSearchEntityTransfer>
     */
    public function findFilteredErpInvoicePageSearchEntities(
        FilterTransfer $filterTransfer,
        array $erpInvoiceIds = []
    ): array {
        $fooErpInvoicePageSearchQuery = $this->getFactory()
            ->getErpInvoicePageSearchQuery();

        if (count($erpInvoiceIds) > 0) {
            $fooErpInvoicePageSearchQuery->filterByFkErpInvoice_In(
                $erpInvoiceIds,
            );
        }

        return $this->buildQueryFromCriteria(
            $fooErpInvoicePageSearchQuery,
            $filterTransfer,
        )->find();
    }
}
