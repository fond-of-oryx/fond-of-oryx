<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchClient;

class ErpOrderPageSearchRestApiToErpOrderPageSearchClientBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPageSearch\ErpOrderPageSearchClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Dependency\Client\ErpOrderPageSearchRestApiToErpOrderPageSearchClientInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->clientMock = $this
            ->getMockBuilder(ErpOrderPageSearchClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ErpOrderPageSearchRestApiToErpOrderPageSearchClientBridge($this->clientMock);
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
