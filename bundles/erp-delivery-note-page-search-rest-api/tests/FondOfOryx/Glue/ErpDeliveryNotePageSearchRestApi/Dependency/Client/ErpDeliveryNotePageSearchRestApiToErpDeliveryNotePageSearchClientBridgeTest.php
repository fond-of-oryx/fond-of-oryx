<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client;

use Codeception\Test\Unit;
use FondOfOryx\Client\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchClient;

class ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpDeliveryNotePageSearch\ErpDeliveryNotePageSearchClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Dependency\Client\ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->clientMock = $this
            ->getMockBuilder(ErpDeliveryNotePageSearchClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ErpDeliveryNotePageSearchRestApiToErpDeliveryNotePageSearchClientBridge($this->clientMock);
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
