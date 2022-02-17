<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\UnPublisher;

interface ErpDeliveryNotePageSearchUnpublisherInterface
{
    /**
     * @param array<int> $erpDeliveryNoteIds
     *
     * @return void
     */
    public function unpublish(array $erpDeliveryNoteIds): void;
}
