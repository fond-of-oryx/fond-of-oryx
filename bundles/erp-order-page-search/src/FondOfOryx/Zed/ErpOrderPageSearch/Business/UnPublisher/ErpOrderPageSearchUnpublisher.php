<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch\Business\UnPublisher;

use FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface;

class ErpOrderPageSearchUnpublisher implements ErpOrderPageSearchUnpublisherInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\ErpOrderPageSearch\Persistence\ErpOrderPageSearchEntityManagerInterface $entityManager
     */
    public function __construct(ErpOrderPageSearchEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array<int> $erpOrderIds
     *
     * @return void
     */
    public function unpublish(array $erpOrderIds): void
    {
        $this->entityManager->deleteErpOrderSearchPagesByErpOrderIds($erpOrderIds);
    }
}
