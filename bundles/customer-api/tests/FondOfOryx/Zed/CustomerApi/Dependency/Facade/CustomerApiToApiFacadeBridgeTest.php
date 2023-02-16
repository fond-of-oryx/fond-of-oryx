<?php


namespace FondOfOryx\Zed\CustomerApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Api\Business\ApiFacadeInterface;

class CustomerApiToApiFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Api\Business\ApiFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected ApiFacadeInterface|MockObject $facadeMock;

    /**
     * @var (\Generated\Shared\Transfer\ApiCollectionTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ApiCollectionTransfer|MockObject $apiCollectionTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\ApiItemTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|ApiItemTransfer $apiItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerApi\Dependency\Facade\CustomerApiToApiFacadeInterface
     */
    protected CustomerApiToApiFacadeInterface $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(ApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CustomerApiToApiFacadeBridge($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $collectionData = [];

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createApiCollection')
            ->with($collectionData)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->bridge->createApiCollection($collectionData),
        );
    }

    /**
     * @return void
     */
    public function testCreateApiItem(): void
    {
        $id = '1';
        $transferMock = $this->getMockBuilder(AbstractTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($transferMock, $id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->bridge->createApiItem($transferMock, $id),
        );
    }
}
