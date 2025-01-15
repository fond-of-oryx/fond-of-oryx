<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi\Persistence;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ThirtyFiveUp\Exception\ThirtyFiveUpOrderNotFoundException;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToApiFacadeBridge;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToApiFacadeInterface;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeBridge;
use FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerBridge;
use FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper\TransferMapper;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiFilterTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\FooThirtyFiveUpOrderEntityTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;
use Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderQuery;
use PHPUnit\Framework\MockObject\MockObject;
use Propel\Runtime\Collection\ObjectCollection;
use Spryker\Zed\Kernel\Container;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ThirtyFiveUpApiRepositoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiRepositoryInterface
     */
    protected $repository;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\ThirtyFiveUpApiPersistenceFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ThirtyFiveUpApiPersistenceFactory|MockObject $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\QueryContainer\ThirtyFiveUpApiToApiQueryBuilderContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpQueryBuilderContainerMock;

    /**
     * @var \Orm\Zed\ThirtyFiveUp\Persistence\FooThirtyFiveUpOrderQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderQueryMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Persistence\Propel\Mapper\TransferMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $transferMapperMock;

    /**
     * @var \Propel\Runtime\Collection\ObjectCollection|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $objectCollectionMock;

    /**
     * @var \Generated\Shared\Transfer\ApiFilterTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiFilterTransferMock;

    /**
     * @var \Generated\Shared\Transfer\FooThirtyFiveUpOrderEntityTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderEntityTransferMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToThirtyFiveUpFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\Dependency\Facade\ThirtyFiveUpApiToApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected ThirtyFiveUpApiToApiFacadeInterface|MockObject $apiFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)->disableOriginalConstructor()->getMock();
        $this->factoryMock = $this->getMockBuilder(ThirtyFiveUpApiPersistenceFactory::class)->disableOriginalConstructor()->getMock();
        $this->objectCollectionMock = $this->getMockBuilder(ObjectCollection::class)->disableOriginalConstructor()->getMock();
        $this->thirtyFiveUpQueryBuilderContainerMock = $this->getMockBuilder(ThirtyFiveUpApiToApiQueryBuilderContainerBridge::class)->disableOriginalConstructor()->getMock();
        $this->apiFacadeMock = $this->getMockBuilder(ThirtyFiveUpApiToApiFacadeBridge::class)->disableOriginalConstructor()->getMock();
        $this->orderQueryMock = $this->getMockBuilder(FooThirtyFiveUpOrderQuery::class)->disableOriginalConstructor()->getMock();
        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFacadeMock = $this->getMockBuilder(ThirtyFiveUpApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->transferMapperMock = $this->getMockBuilder(TransferMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFilterTransferMock = $this->getMockBuilder(ApiFilterTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderEntityTransferMock = $this->getMockBuilder(FooThirtyFiveUpOrderEntityTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(ThirtyFiveUpApiToThirtyFiveUpFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(ThirtyFiveUpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->repository = new ThirtyFiveUpApiRepository();
        $this->repository->setContainer($this->containerMock);
        $this->repository->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->factoryMock->expects($this->once())->method('getThirtyFiveUpOrderQuery')->willReturn($this->orderQueryMock);
        $this->factoryMock->expects($this->once())->method('getQueryBuilderContainer')->willReturn($this->thirtyFiveUpQueryBuilderContainerMock);
        $this->factoryMock->expects($this->once())->method('createTransferMapper')->willReturn($this->transferMapperMock);
        $this->factoryMock->expects($this->once())->method('getApiFacade')->willReturn($this->apiFacadeMock);
        $this->thirtyFiveUpQueryBuilderContainerMock->expects($this->once())->method('buildQueryFromRequest')->willReturn($this->orderQueryMock);
        $this->transferMapperMock->expects($this->once())->method('toTransferCollection')->willReturn([]);
        $this->apiFacadeMock->expects($this->once())->method('createApiCollection')->willReturn($this->apiCollectionTransferMock);
        $this->orderQueryMock->expects($this->once())->method('find')->willReturn($this->objectCollectionMock);
        $this->orderQueryMock->expects($this->once())->method('count')->willReturn(1);
        $this->objectCollectionMock->expects($this->once())->method('getData')->willReturn([]);
        $this->apiCollectionTransferMock->expects($this->once())->method('setPagination');
        $this->apiCollectionTransferMock->expects($this->once())->method('setData')->willReturnSelf();
        $this->apiRequestTransferMock->method('getFilter')->willReturn($this->apiFilterTransferMock);
        $this->apiFilterTransferMock->method('getLimit')->willReturn(1);
        $this->apiFilterTransferMock->method('getOffset')->willReturn(0);

        $this->repository->find($this->apiRequestTransferMock);
    }

    /**
     * @return void
     */
    public function testFindOutOfBoundException(): void
    {
        $this->factoryMock->expects($this->once())->method('getThirtyFiveUpOrderQuery')->willReturn($this->orderQueryMock);
        $this->factoryMock->expects($this->once())->method('getQueryBuilderContainer')->willReturn($this->thirtyFiveUpQueryBuilderContainerMock);
        $this->factoryMock->expects($this->once())->method('createTransferMapper')->willReturn($this->transferMapperMock);
        $this->factoryMock->expects($this->once())->method('getApiFacade')->willReturn($this->apiFacadeMock);
        $this->apiFacadeMock->expects($this->once())->method('createApiCollection')->willReturn($this->apiCollectionTransferMock);
        $this->thirtyFiveUpQueryBuilderContainerMock->expects($this->once())->method('buildQueryFromRequest')->willReturn($this->orderQueryMock);
        $this->transferMapperMock->expects($this->once())->method('toTransferCollection')->willReturn([]);
        $this->orderQueryMock->expects($this->once())->method('find')->willReturn($this->objectCollectionMock);
        $this->apiCollectionTransferMock->expects($this->once())->method('setData')->willReturnSelf();
        $this->orderQueryMock->expects($this->once())->method('count')->willReturn(1);
        $this->objectCollectionMock->expects($this->once())->method('getData')->willReturn([]);
        $this->apiCollectionTransferMock->expects($this->never())->method('setPagination');
        $this->apiRequestTransferMock->method('getFilter')->willReturn($this->apiFilterTransferMock);
        $this->apiFilterTransferMock->method('getLimit')->willReturn(1);
        $this->apiFilterTransferMock->method('getOffset')->willReturn(1);

        $catch = null;
        try {
            $this->repository->find($this->apiRequestTransferMock);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertInstanceOf(NotFoundHttpException::class, $catch);
    }

    /**
     * @return void
     */
    public function testConvert(): void
    {
        $this->factoryMock->expects($this->once())->method('getThirtyFiveUpFacade')->willReturn($this->facadeMock);
        $this->facadeMock->expects($this->once())->method('findThirtyFiveUpOrderById')->willReturn($this->orderTransferMock);
        $this->orderEntityTransferMock->expects($this->once())->method('getIdThirtyFiveUpOrder')->willReturn(1);
        $this->orderTransferMock->expects($this->once())->method('getId')->willReturn(1);

        $this->repository->convert($this->orderEntityTransferMock);
    }

    /**
     * @return void
     */
    public function testConvertThrowsException(): void
    {
        $this->factoryMock->expects($this->once())->method('getThirtyFiveUpFacade')->willReturn($this->facadeMock);
        $this->facadeMock->expects($this->once())->method('findThirtyFiveUpOrderById')->willReturn(null);
        $this->orderEntityTransferMock->expects($this->exactly(2))->method('getIdThirtyFiveUpOrder')->willReturn(1);
        $this->apiFacadeMock->expects($this->never())->method('createApiItem')->willReturn($this->apiItemTransferMock);

        $catch = null;
        try {
            $this->repository->convert($this->orderEntityTransferMock);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertInstanceOf(ThirtyFiveUpOrderNotFoundException::class, $catch);
    }
}
