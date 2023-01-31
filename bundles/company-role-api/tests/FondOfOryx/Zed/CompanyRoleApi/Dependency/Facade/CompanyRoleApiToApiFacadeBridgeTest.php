<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Api\Business\ApiFacadeInterface;

class CompanyRoleApiToApiFacadeBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyRoleApi\Dependency\Facade\CompanyRoleApiToApiFacadeBridge
     */
    protected $bridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Api\Business\ApiFacadeInterface
     */
    protected $apiFacadeMock;

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

        $this->apiFacadeMock = $this->getMockBuilder(ApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->collectionData = [];

        $this->bridge = new CompanyRoleApiToApiFacadeBridge($this->apiFacadeMock);
    }

    /**
     * @return void
     */
    public function testCreateApiCollection(): void
    {
        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiCollection')
            ->with($this->collectionData)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->bridge->createApiCollection($this->collectionData),
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

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($transferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->bridge->createApiItem($transferMock, $id),
        );
    }
}
