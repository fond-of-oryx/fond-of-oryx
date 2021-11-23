<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch\Business\UnPublisher;

use FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface;

class ErpInvoicePageSearchUnpublisher implements ErpInvoicePageSearchUnpublisherInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\ErpInvoicePageSearch\Persistence\ErpInvoicePageSearchEntityManagerInterface $entityManager
     */
    public function __construct(ErpInvoicePageSearchEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array<int> $erpInvoiceIds
     *
     * @return void
     */
    public function unpublish(array $erpInvoiceIds): void
    {
        $this->entityManager->deleteErpInvoiceSearchPagesByErpInvoiceIds($erpInvoiceIds);
    }
}
