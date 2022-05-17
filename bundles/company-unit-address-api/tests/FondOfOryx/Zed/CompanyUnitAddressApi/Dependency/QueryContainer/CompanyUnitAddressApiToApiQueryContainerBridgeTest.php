<?php

namespace FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Zed\Api\Persistence\ApiQueryContainerInterface;

class CompanyUnitAddressApiToApiQueryContainerBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Persistence\ApiQueryContainerInterface
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
     * @var \FondOfOryx\Zed\CompanyUnitAddressApi\Dependency\QueryContainer\CompanyUnitAddressApiToApiQueryContainerBridge
     */
    protected $apiQueryContainerBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->apiQueryContainerMock = $this->getMockBuilder(ApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiQueryContainerBridge = new CompanyUnitAddressApiToApiQueryContainerBridge(
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
            $this->apiQueryContainerBridge->createApiCollection($data),
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
            $this->apiQueryContainerBridge->createApiItem($data),
        );
    }
}
