<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Api\Business\ApiFacadeInterface;

class ErpDeliveryNoteApiToApiFacadeBridgeTest extends Unit
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
     * @var int
     */
    protected $id;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Shared\Kernel\Transfer\AbstractTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToApiFacadeBridge
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

        $this->id = 1;

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ErpDeliveryNoteApiToApiFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testCreateApiItem(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->abstractTransferMock, $this->id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->bridge->createApiItem(
                $this->abstractTransferMock,
                (string)$this->id,
            ),
        );
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createApiCollection')
            ->with([])
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->bridge->createApiCollection([]),
        );
    }
}
