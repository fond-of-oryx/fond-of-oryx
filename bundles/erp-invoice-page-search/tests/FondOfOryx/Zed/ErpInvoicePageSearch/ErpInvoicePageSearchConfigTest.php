<?php

namespace FondOfOryx\Zed\ErpInvoicePageSearch;

use Codeception\Test\Unit;

class ErpInvoicePageSearchConfigTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpInvoicePageSearch\ErpInvoicePageSearchConfig
     */
    protected $erpInvoicePageSearchConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpInvoicePageSearchConfig = new ErpInvoicePageSearchConfig();
    }

    /**
     * @return void
     */
    public function testGetErpInvoicePageSynchronizationPoolName(): void
    {
        $this->assertEquals(null, $this->erpInvoicePageSearchConfig->getErpInvoicePageSynchronizationPoolName());
    }

    /**
     * @return void
     */
    public function testGetEventQueueName(): void
    {
        $this->assertEquals(null, $this->erpInvoicePageSearchConfig->getEventQueueName());
    }
}
