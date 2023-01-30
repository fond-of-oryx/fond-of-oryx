<?php

namespace FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Api\Business\ApiFacadeInterface;

class ConcreteProductApiToApiFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Business\ApiFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected $abstractTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ConcreteProductApi\Dependency\Facade\ConcreteProductApiToApiFacadeBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->facadeMock = $this->getMockBuilder(ApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->abstractTransferMock = $this->getMockBuilder(AbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ConcreteProductApiToApiFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testCreateApiItem(): void
    {
        $id = '1';

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->abstractTransferMock, $id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->bridge->createApiItem($this->abstractTransferMock, $id),
        );
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $data = [];

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createApiCollection')
            ->with($data)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->bridge->createApiCollection($data),
        );
    }
}
