<?php

namespace FondOfOryx\Service\Trbo;

use Codeception\Test\Unit;
use FondOfOryx\Service\Trbo\Api\TrboApi;
use Generated\Shared\Transfer\TrboDataTransfer;
use Symfony\Component\HttpFoundation\Request;

class TrboServiceTest extends Unit
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestMock;

    /**
     * @var \FondOfOryx\Service\Trbo\TrboServiceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\TrboDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $trboDataTransferMock;

    /**
     * @var \FondOfOryx\Service\Trbo\Api\TrboApi|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $trboApiMock;

    /**
     * @var \FondOfOryx\Service\Trbo\TrboService
     */
    protected $service;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->trboDataTransferMock = $this->getMockBuilder(TrboDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(TrboServiceFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->trboApiMock = $this->getMockBuilder(TrboApi::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->service = new TrboService();
        $this->service->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testRequestDataReturnTransfer(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTrboApi')
            ->willReturn($this->trboApiMock);

        $this->trboApiMock->expects(static::atLeastOnce())
            ->method('requestData')
            ->willReturn($this->trboDataTransferMock);

        static::assertEquals($this->trboDataTransferMock, $this->service->requestData($this->requestMock));
    }

    /**
     * @return void
     */
    public function testRequestDataReturnNull(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTrboApi')
            ->willReturn($this->trboApiMock);

        $this->trboApiMock->expects(static::atLeastOnce())
            ->method('requestData')
            ->willReturn(null);

        static::assertNull($this->service->requestData($this->requestMock));
    }
}
