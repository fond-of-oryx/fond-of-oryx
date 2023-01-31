<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Dependency\QueryContainer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToApiFacadeBridge;
use Generated\Shared\Transfer\ApiItemTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Zed\Api\Business\ApiFacadeInterface;

class CustomerProductListApiToApiFacadeBridgeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiItemTransferMock;

    /**
     * @var \Spryker\Zed\Api\Business\ApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToApiFacadeInterface
     */
    protected $dependencyQueryContainer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiFacadeMock = $this
            ->getMockBuilder(ApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this
            ->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyQueryContainer = new CustomerProductListApiToApiFacadeBridge(
            $this->apiFacadeMock,
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
            ->with($transferMock, $id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->dependencyQueryContainer->createApiItem($transferMock, $id),
        );
    }
}
