<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\Manager\TradeFairRepresentationManagerInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;

class RepresentativeCompanyUserTradeFairFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\RepresentativeCompanyUserTradeFairBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\Manager\TradeFairRepresentationManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $tradeFairRepresentationManager;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTradeFairTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $representativeCompanyUserTradeFairCollectionTransfer;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\RepresentativeCompanyUserTradeFairFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->tradeFairRepresentationManager = $this->getMockBuilder(TradeFairRepresentationManagerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairCollectionTransfer = $this->getMockBuilder(RepresentativeCompanyUserTradeFairCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairTransferMock = $this->getMockBuilder(RepresentativeCompanyUserTradeFairTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new RepresentativeCompanyUserTradeFairFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testCreateRepresentativeCompanyUserTradeFair(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManager);

        $this->tradeFairRepresentationManager->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->representativeCompanyUserTradeFairTransferMock)
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->facade->createRepresentativeCompanyUserTradeFair($this->representativeCompanyUserTradeFairTransferMock);
    }

    /**
     * @return void
     */
    public function testUpdateRepresentativeCompanyUserTradeFair(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManager);

        $this->tradeFairRepresentationManager->expects(static::atLeastOnce())
            ->method('update')
            ->with($this->representativeCompanyUserTradeFairTransferMock)
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->facade->updateRepresentativeCompanyUserTradeFair($this->representativeCompanyUserTradeFairTransferMock);
    }

    /**
     * @return void
     */
    public function testDeleteRepresentativeCompanyUserTradeFair(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManager);

        $this->tradeFairRepresentationManager->expects(static::atLeastOnce())
            ->method('delete')
            ->with('uuid')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->facade->deleteRepresentativeCompanyUserTradeFair('uuid');
    }

    /**
     * @return void
     */
    public function testGetRepresentativeCompanyUserTradeFair(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManager);

        $this->tradeFairRepresentationManager->expects(static::atLeastOnce())
            ->method('get')
            ->with($this->filterTransferMock)
            ->willReturn($this->representativeCompanyUserTradeFairCollectionTransfer);

        $this->facade->getRepresentativeCompanyUserTradeFair($this->filterTransferMock);
    }

    /**
     * @return void
     */
    public function testFindTradeFairRepresentationByUuid(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createTradeFairRepresentationManager')
            ->willReturn($this->tradeFairRepresentationManager);

        $this->tradeFairRepresentationManager->expects(static::atLeastOnce())
            ->method('findByUuid')
            ->with('uuid')
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $this->facade->findTradeFairRepresentationByUuid('uuid');
    }
}
