<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchClient;

class ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpInvoicePageSearch\ErpInvoicePageSearchClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Dependency\Client\ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->clientMock = $this
            ->getMockBuilder(ErpInvoicePageSearchClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ErpInvoicePageSearchRestApiToErpInvoicePageSearchClientBridge($this->clientMock);
    }

    /**
     * @return void
     */
    public function testSearch(): void
    {
        $this->clientMock->expects($this->once())->method('search')->willReturn([]);

        $result = $this->bridge->search('', []);

        $this->assertIsArray($result);
    }
}
