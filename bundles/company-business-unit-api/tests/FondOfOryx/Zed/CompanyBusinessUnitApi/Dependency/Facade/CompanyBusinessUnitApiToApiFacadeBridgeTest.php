<?php


namespace FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Api\Business\ApiFacadeInterface;

class CompanyBusinessUnitApiToApiFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitApi\Dependency\Facade\CompanyBusinessUnitApiToApiFacadeInterface
     */
    protected $bridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Business\ApiFacadeInterface
     */
    protected $facadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var array
     */
    protected $collectionData;

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

        $this->bridge = new CompanyBusinessUnitApiToApiFacadeBridge($this->facadeMock);
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
