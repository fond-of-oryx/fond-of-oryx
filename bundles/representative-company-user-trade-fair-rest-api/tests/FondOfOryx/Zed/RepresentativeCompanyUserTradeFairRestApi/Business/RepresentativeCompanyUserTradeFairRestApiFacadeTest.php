<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\TradeFairRepresentationManagerInterface;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RepresentativeCompanyUserTradeFairRestApiFacadeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\RepresentativeCompanyUserTradeFairRestApiBusinessFactory
     */
    protected MockObject|RepresentativeCompanyUserTradeFairRestApiBusinessFactory $factoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairRequestTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserTradeFairRequestTransfer $restRepresentativeCompanyUserTradeFairRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairResponseTransfer
     */
    protected MockObject|RestRepresentativeCompanyUserTradeFairResponseTransfer $restRepresentativeCompanyUserTradeFairResponseTransferMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\RepresentativeCompanyUserTradeFairRestApiFacadeInterface
     */
    protected RepresentativeCompanyUserTradeFairRestApiFacadeInterface $facade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Business\Model\TradeFairRepresentationManagerInterface
     */
    protected MockObject|TradeFairRepresentationManagerInterface $tradeFairRepresentationManagerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTradeFairResponseTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRepresentativeCompanyUserTradeFairRequestTransferMock = $this
            ->getMockBuilder(RestRepresentativeCompanyUserTradeFairRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->tradeFairRepresentationManagerMock = $this
            ->getMockBuilder(TradeFairRepresentationManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new RepresentativeCompanyUserTradeFairRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testAddTradeFairRepresentation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManagerMock);

        $this->tradeFairRepresentationManagerMock->expects(static::atLeastOnce())
            ->method('addTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $responseTransfer = $this->facade
            ->addTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        static::assertEquals(
            $this->restRepresentativeCompanyUserTradeFairResponseTransferMock,
            $responseTransfer,
        );
    }

    /**
     * @return void
     */
    public function testGetTradeFairRepresentation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManagerMock);

        $this->tradeFairRepresentationManagerMock->expects(static::atLeastOnce())
            ->method('getTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $responseTransfer = $this->facade
            ->getTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        static::assertEquals(
            $this->restRepresentativeCompanyUserTradeFairResponseTransferMock,
            $responseTransfer,
        );
    }

    /**
     * @return void
     */
    public function testUpdateTradeFairRepresentation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManagerMock);

        $this->tradeFairRepresentationManagerMock->expects(static::atLeastOnce())
            ->method('updateTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $responseTransfer = $this->facade
            ->updateTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        static::assertEquals(
            $this->restRepresentativeCompanyUserTradeFairResponseTransferMock,
            $responseTransfer,
        );
    }

    /**
     * @return void
     */
    public function testDeleteTradeFairRepresentation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManagerMock);

        $this->tradeFairRepresentationManagerMock->expects(static::atLeastOnce())
            ->method('deleteTradeFairRepresentation')
            ->with($this->restRepresentativeCompanyUserTradeFairRequestTransferMock)
            ->willReturn($this->restRepresentativeCompanyUserTradeFairResponseTransferMock);

        $responseTransfer = $this->facade
            ->deleteTradeFairRepresentation($this->restRepresentativeCompanyUserTradeFairRequestTransferMock);

        static::assertEquals(
            $this->restRepresentativeCompanyUserTradeFairResponseTransferMock,
            $responseTransfer,
        );
    }
}
