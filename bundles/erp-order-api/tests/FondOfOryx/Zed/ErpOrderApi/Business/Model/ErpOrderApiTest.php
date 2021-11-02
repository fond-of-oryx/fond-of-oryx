<?php

namespace FondOfOryx\Zed\ErpOrderApi\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeInterface;
use FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryContainerInterface;
use FondOfOryx\Zed\ErpOrderApi\Persistence\ErpOrderApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ErpOrderResponseTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderApiTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Dependency\QueryContainer\ErpOrderApiToApiQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiQueryContainerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Dependency\Facade\ErpOrderApiToErpOrderFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderResponseTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiDataTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Persistence\ErpOrderApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderApiRepositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderApi\Business\Model\ErpOrderApi
     */
    protected $erpOrderApi;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiQueryContainerMock = $this->getMockBuilder(ErpOrderApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderFacadeMock = $this->getMockBuilder(ErpOrderApiToErpOrderFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTransferMock = $this->getMockBuilder(ErpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderResponseTransferMock = $this->getMockBuilder(ErpOrderResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderApiRepositoryMock = $this->getMockBuilder(ErpOrderApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderApi = new ErpOrderApi(
            $this->apiQueryContainerMock,
            $this->erpOrderFacadeMock,
            $this->erpOrderApiRepositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $idErpOrder = 1;

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('createErpOrder')
            ->willReturn($this->erpOrderResponseTransferMock);

        $this->erpOrderResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErpOrder')
            ->willReturn($this->erpOrderTransferMock);

        $this->erpOrderResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('getIdErpOrder')
            ->willReturn($idErpOrder);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->erpOrderTransferMock, $idErpOrder)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpOrderApi->create($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testCreateWithError(): void
    {
        $idErpOrder = 1;

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('createErpOrder')
            ->willReturn($this->erpOrderResponseTransferMock);

        $this->erpOrderResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErpOrder')
            ->willReturn(null);

        $this->erpOrderResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->erpOrderTransferMock->expects(static::never())
            ->method('getIdErpOrder');

        $this->apiQueryContainerMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->erpOrderApi->create($this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $idErpOrder = 1;

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('findErpOrderByIdErpOrder')
            ->with($idErpOrder)
            ->willReturn($this->erpOrderTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('updateErpOrder')
            ->willReturn($this->erpOrderResponseTransferMock);

        $this->erpOrderResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErpOrder')
            ->willReturn($this->erpOrderTransferMock);

        $this->erpOrderResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('getIdErpOrder')
            ->willReturn($idErpOrder);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->erpOrderTransferMock, $idErpOrder)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpOrderApi->update($idErpOrder, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateWithError(): void
    {
        $idErpOrder = 1;

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('findErpOrderByIdErpOrder')
            ->with($idErpOrder)
            ->willReturn($this->erpOrderTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('updateErpOrder')
            ->willReturn($this->erpOrderResponseTransferMock);

        $this->erpOrderResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErpOrder')
            ->willReturn(null);

        $this->erpOrderResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->erpOrderTransferMock->expects(static::never())
            ->method('getIdErpOrder');

        $this->apiQueryContainerMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->erpOrderApi->update($idErpOrder, $this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $idErpOrder = 1;

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('findErpOrderByIdErpOrder')
            ->with($idErpOrder)
            ->willReturn($this->erpOrderTransferMock);

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('deleteErpOrderByIdErpOrder')
            ->with($idErpOrder);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with(new ErpOrderTransfer(), $idErpOrder)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpOrderApi->delete($idErpOrder),
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $idErpOrder = 1;

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('findErpOrderByIdErpOrder')
            ->with($idErpOrder)
            ->willReturn($this->erpOrderTransferMock);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->erpOrderTransferMock, $idErpOrder)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpOrderApi->get($idErpOrder),
        );
    }

    /**
     * @return void
     */
    public function testGetWithNotExistingErpOrder(): void
    {
        $idErpOrder = 2;

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('findErpOrderByIdErpOrder')
            ->with($idErpOrder)
            ->willReturn(null);

        try {
            $this->erpOrderApi->get($idErpOrder);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $apiCollectionTransferData = [
            [
                'id_erp_order' => 1,
            ],
            [],
        ];

        $data = [
            'id_erp_order' => 1,
            'foo' => 'bar',
        ];

        $this->erpOrderApiRepositoryMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($apiCollectionTransferData);

        $this->erpOrderFacadeMock->expects(static::atLeastOnce())
            ->method('findErpOrderByIdErpOrder')
            ->with($apiCollectionTransferData[0]['id_erp_order'])
            ->willReturn($this->erpOrderTransferMock);

        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('setData')
            ->with(
                static::callback(
                    static function (array $newData) use ($data) {
                        return count($newData) === 1
                            && isset($newData[0]['id_erp_order'], $newData[0]['foo'])
                            && $newData[0]['id_erp_order'] === $data['id_erp_order']
                            && $newData[0]['foo'] === $data['foo'];
                    },
                ),
            )->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->erpOrderApi->find($this->apiRequestTransferMock),
        );
    }
}
