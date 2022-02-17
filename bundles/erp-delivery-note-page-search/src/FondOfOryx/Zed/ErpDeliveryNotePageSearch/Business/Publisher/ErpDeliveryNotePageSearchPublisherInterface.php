<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch\Business\Publisher;

interface ErpDeliveryNotePageSearchPublisherInterface
{
    /**
     * @param array<int> $erpDeliveryNoteIds
     *
     * @return void
     */
    public function publish(array $erpDeliveryNoteIds): void;
}
