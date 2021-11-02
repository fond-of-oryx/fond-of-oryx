<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeBridge;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerBridge;
use FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepository;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Spryker\Zed\Api\Business\Exception\EntityNotSavedException;

class ThirtyFiveUpOrderApiTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Business\Model\ThirtyFiveUpOrderApiInterface
     */
    protected $orderApi;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpQueryContainerMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpApiFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->thirtyFiveUpApiFacadeMock = $this->getMockBuilder(ThirtyFiveUpApiToThirtyFiveUpFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->thirtyFiveUpQueryContainerMock = $this->getMockBuilder(ThirtyFiveUpApiToApiQueryContainerBridge::class)->disableOriginalConstructor()->getMock();
        $this->repositoryMock = $this->getMockBuilder(ThirtyFiveUpApiRepository::class)->disableOriginalConstructor()->getMock();
        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)->disableOriginalConstructor()->getMock();
        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)->disableOriginalConstructor()->getMock();
        $this->thirtyFiveUpOrderTransferMock = $this->getMockBuilder(ThirtyFiveUpOrderTransfer::class)->disableOriginalConstructor()->getMock();
        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)->disableOriginalConstructor()->getMock();
        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)->disableOriginalConstructor()->getMock();

        $this->orderApi = new ThirtyFiveUpOrderApi(
            $this->thirtyFiveUpQueryContainerMock,
            $this->thirtyFiveUpApiFacadeMock,
            $this->repositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->apiDataTransferMock->method('getData')->willReturn([]);
        $this->thirtyFiveUpApiFacadeMock->expects($this->once())->method('updateThirtyFiveUpOrder')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->thirtyFiveUpQueryContainerMock->expects($this->once())->method('createApiItem')->willReturn($this->apiItemTransferMock);
        $this->thirtyFiveUpOrderTransferMock->expects($this->once())->method('getId')->willReturn(1);

        $this->orderApi->update(1, $this->apiDataTransferMock);
    }

    /**
     * @return void
     */
    public function testUpdateThrowsException(): void
    {
        $this->apiDataTransferMock->method('getData')->willReturn([]);
        $this->thirtyFiveUpApiFacadeMock->expects($this->once())->method('updateThirtyFiveUpOrder')->willThrowException(new Exception(''));
        $this->thirtyFiveUpQueryContainerMock->expects($this->never())->method('createApiItem');
        $this->thirtyFiveUpOrderTransferMock->expects($this->never())->method('getId');

        $catch = null;
        try {
            $this->orderApi->update(1, $this->apiDataTransferMock);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertInstanceOf(EntityNotSavedException::class, $catch);
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->repositoryMock->expects($this->once())->method('find')->willReturn($this->apiCollectionTransferMock);
        $this->orderApi->find($this->apiRequestTransferMock);
    }
}
