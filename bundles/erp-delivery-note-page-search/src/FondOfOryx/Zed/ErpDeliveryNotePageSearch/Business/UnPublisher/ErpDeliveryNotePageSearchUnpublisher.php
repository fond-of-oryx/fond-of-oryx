<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\UnPublisher;

use FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface;

class ErpDeliveryNotePageSearchUnpublisher implements ErpDeliveryNotePageSearchUnpublisherInterface
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\ErpDeliveryNotePageSearch\Persistence\ErpDeliveryNotePageSearchEntityManagerInterface $entityManager
     */
    public function __construct(ErpDeliveryNotePageSearchEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param array<int> $erpDeliveryNoteIds
     *
     * @return void
     */
    public function unpublish(array $erpDeliveryNoteIds): void
    {
        $this->entityManager->deleteErpDeliveryNoteSearchPagesByErpDeliveryNoteIds($erpDeliveryNoteIds);
    }
}
