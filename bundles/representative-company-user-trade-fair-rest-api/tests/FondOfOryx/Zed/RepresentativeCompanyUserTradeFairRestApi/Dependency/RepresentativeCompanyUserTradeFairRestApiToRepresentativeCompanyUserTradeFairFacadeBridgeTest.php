<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\RepresentativeCompanyUserTradeFairFacadeInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;
use PHPUnit\Framework\MockObject\MockObject;

class RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\RepresentativeCompanyUserTradeFairFacadeInterface
     */
    protected MockObject|RepresentativeCompanyUserTradeFairFacadeInterface $facadeMock;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade\RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface
     */
    protected RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface $facadeBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer
     */
    protected MockObject|RepresentativeCompanyUserTradeFairFilterTransfer $representativeCompanyUserTradeFairFilterTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    protected MockObject|RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
     */
    protected MockObject|RepresentativeCompanyUserTradeFairCollectionTransfer $representativeCompanyUserTradeFairCollectionTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairFilterTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->representativeCompanyUserTradeFairCollectionTransferMock = $this
            ->getMockBuilder(RepresentativeCompanyUserTradeFairCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeBridge = new RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testAddRepresentativeCompanyUserTradeFair(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createRepresentativeCompanyUserTradeFair')
            ->with($this->representativeCompanyUserTradeFairTransferMock)
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $transfer = $this->facadeBridge
            ->addRepresentativeCompanyUserTradeFair($this->representativeCompanyUserTradeFairTransferMock);

        static::assertEquals(
            $this->representativeCompanyUserTradeFairTransferMock,
            $transfer,
        );
    }

    /**
     * @return void
     */
    public function testUpdateRepresentativeCompanyUserTradeFair(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('updateRepresentativeCompanyUserTradeFair')
            ->with($this->representativeCompanyUserTradeFairTransferMock)
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $transfer = $this->facadeBridge
            ->updateRepresentativeCompanyUserTradeFair($this->representativeCompanyUserTradeFairTransferMock);

        static::assertEquals(
            $this->representativeCompanyUserTradeFairTransferMock,
            $transfer,
        );
    }

    /**
     * @return void
     */
    public function testFindTradeFairRepresentationByUuid(): void
    {
        $uuid = 'xxx-xxxx-xxx-xxxx-xxx';
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('findTradeFairRepresentationByUuid')
            ->with($uuid)
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $transfer = $this->facadeBridge->findTradeFairRepresentationByUuid($uuid);

        static::assertEquals(
            $this->representativeCompanyUserTradeFairTransferMock,
            $transfer,
        );
    }

    /**
     * @return void
     */
    public function testDeleteRepresentativeCompanyUserTradeFair(): void
    {
        $uuid = 'xxx-xxxx-xxx-xxxx-xxx';
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('deleteRepresentativeCompanyUserTradeFair')
            ->with($uuid)
            ->willReturn($this->representativeCompanyUserTradeFairTransferMock);

        $transfer = $this->facadeBridge->deleteRepresentativeCompanyUserTradeFair($uuid);

        static::assertEquals(
            $this->representativeCompanyUserTradeFairTransferMock,
            $transfer,
        );
    }

    /**
     * @return void
     */
    public function testGetRepresentativeCompanyUserTradeFair(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('getRepresentativeCompanyUserTradeFair')
            ->with($this->representativeCompanyUserTradeFairFilterTransferMock)
            ->willReturn($this->representativeCompanyUserTradeFairCollectionTransferMock);

        $collectionTransfer = $this->facadeBridge
            ->getRepresentativeCompanyUserTradeFair($this->representativeCompanyUserTradeFairFilterTransferMock);

        static::assertEquals(
            $this->representativeCompanyUserTradeFairCollectionTransferMock,
            $collectionTransfer,
        );
    }
}
