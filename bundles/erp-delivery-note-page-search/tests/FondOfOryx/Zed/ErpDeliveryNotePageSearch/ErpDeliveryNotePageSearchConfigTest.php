<?php

namespace FondOfOryx\Zed\ErpDeliveryNotePageSearch;

use Codeception\Test\Unit;

class ErpDeliveryNotePageSearchConfigTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchConfig
     */
    protected $erpDeliveryNotePageSearchConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpDeliveryNotePageSearchConfig = new ErpDeliveryNotePageSearchConfig();
    }

    /**
     * @return void
     */
    public function testGetErpDeliveryNotePageSynchronizationPoolName(): void
    {
        $this->assertEquals(null, $this->erpDeliveryNotePageSearchConfig->getErpDeliveryNotePageSynchronizationPoolName());
    }

    /**
     * @return void
     */
    public function testGetEventQueueName(): void
    {
        $this->assertEquals(null, $this->erpDeliveryNotePageSearchConfig->getEventQueueName());
    }
}
