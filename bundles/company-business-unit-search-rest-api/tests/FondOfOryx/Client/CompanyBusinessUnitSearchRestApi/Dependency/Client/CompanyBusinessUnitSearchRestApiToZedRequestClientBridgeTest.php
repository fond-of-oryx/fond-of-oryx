<?php

namespace FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\ZedRequest\ZedRequestClientInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

class CompanyBusinessUnitSearchRestApiToZedRequestClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\ZedRequest\ZedRequestClientInterface
     */
    protected $zedRequestClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected $transferMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\Dependency\Client\CompanyBusinessUnitSearchRestApiToZedRequestClientBridge
     */
    protected $zedRequestClientBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->zedRequestClientMock = $this->getMockBuilder(ZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMock = $this->getMockBuilder(TransferInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientBridge = new CompanyBusinessUnitSearchRestApiToZedRequestClientBridge(
            $this->zedRequestClientMock,
        );
    }

    /**
     * @return void
     */
    public function testCall(): void
    {
        $url = 'url';

        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with($url, $this->transferMock, null)
            ->willReturn($this->transferMock);

        static::assertEquals(
            $this->transferMock,
            $this->zedRequestClientBridge->call($url, $this->transferMock),
        );
    }
}
