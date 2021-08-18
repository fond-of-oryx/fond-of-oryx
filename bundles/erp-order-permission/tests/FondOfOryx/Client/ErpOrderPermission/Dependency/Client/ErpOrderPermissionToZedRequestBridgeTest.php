<?php

namespace FondOfOryx\Client\ErpOrderPermission\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

class ErpOrderPermissionToZedRequestBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ErpOrderPermission\Dependency\Client\ErpOrderPermissionToZedRequestInterface
     */
    protected $client;

    /**
     * @var \Spryker\Client\ZedRequest\ZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \Spryker\Shared\Kernel\Transfer\TransferInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transferMock;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->zedRequestClientMock = $this->getMockBuilder(ZedRequestClientInterface::class)->disableOriginalConstructor()->getMock();
        $this->transferMock = $this->getMockBuilder(TransferInterface::class)->disableOriginalConstructor()->getMock();

        $this->client = new ErpOrderPermissionToZedRequestBridge($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testCall(): void
    {
        $this->zedRequestClientMock->expects(static::once())->method('call')->willReturn($this->transferMock);
        $this->client->call('', $this->transferMock, 10);
    }
}
