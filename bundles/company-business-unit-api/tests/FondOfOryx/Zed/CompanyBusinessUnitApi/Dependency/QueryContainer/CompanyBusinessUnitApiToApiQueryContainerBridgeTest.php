<?php

namespace FondOfOryx\Zed\CompanyApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerBridge;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Api\Persistence\ApiQueryContainer;

class CompanyBusinessUnitApiToApiQueryContainerBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Persistence\ApiQueryContainer
     */
    protected $apiQueryContainerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\QueryContainer\CompanyBusinessUnitApiToApiQueryContainerBridge
     */
    protected $queryContainerBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiQueryContainerMock = $this->getMockBuilder(ApiQueryContainer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainerBridge = new CompanyBusinessUnitApiToApiQueryContainerBridge(
            $this->apiQueryContainerMock,
        );
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $data = [];

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiCollection')
            ->with($data)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->queryContainerBridge->createApiCollection($data),
        );
    }

    /**
     * @return void
     */
    public function testCreateApiItem(): void
    {
        $data = [];

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($data)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->queryContainerBridge->createApiItem($data),
        );
    }
}
