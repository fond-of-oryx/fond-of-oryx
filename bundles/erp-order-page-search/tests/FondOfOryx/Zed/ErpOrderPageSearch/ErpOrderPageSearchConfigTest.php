<?php

namespace FondOfOryx\Zed\ErpOrderPageSearch;

use Codeception\Test\Unit;

class ErpOrderPageSearchConfigTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderPageSearch\ErpOrderPageSearchConfig
     */
    protected $erpOrderPageSearchConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpOrderPageSearchConfig = new ErpOrderPageSearchConfig();
    }

    /**
     * @return void
     */
    public function testGetErpOrderPageSynchronizationPoolName(): void
    {
        $this->assertEquals(null, $this->erpOrderPageSearchConfig->getErpOrderPageSynchronizationPoolName());
    }

    /**
     * @return void
     */
    public function testGetEventQueueName(): void
    {
        $this->assertEquals(null, $this->erpOrderPageSearchConfig->getEventQueueName());
    }
}
