<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToApiFacadeInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Persistence\ErpDeliveryNoteApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer;
use Generated\Shared\Transfer\ErpDeliveryNoteTransfer;

class ErpDeliveryNoteApiTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToApiFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Dependency\Facade\ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpDeliveryNoteResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteResponseTransferMock;

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
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Persistence\ErpDeliveryNoteApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpDeliveryNoteApiRepositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Business\Model\ErpDeliveryNoteApi
     */
    protected $erpDeliveryNoteApi;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiFacadeMock = $this->getMockBuilder(ErpDeliveryNoteApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteFacadeMock = $this->getMockBuilder(ErpDeliveryNoteApiToErpDeliveryNoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteTransferMock = $this->getMockBuilder(ErpDeliveryNoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteResponseTransferMock = $this->getMockBuilder(ErpDeliveryNoteResponseTransfer::class)
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

        $this->erpDeliveryNoteApiRepositoryMock = $this->getMockBuilder(ErpDeliveryNoteApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpDeliveryNoteApi = new ErpDeliveryNoteApi(
            $this->apiFacadeMock,
            $this->erpDeliveryNoteFacadeMock,
            $this->erpDeliveryNoteApiRepositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $idErpDeliveryNote = 1;

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('createErpDeliveryNote')
            ->willReturn($this->erpDeliveryNoteResponseTransferMock);

        $this->erpDeliveryNoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErpDeliveryNote')
            ->willReturn($this->erpDeliveryNoteTransferMock);

        $this->erpDeliveryNoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->erpDeliveryNoteTransferMock->expects(static::atLeastOnce())
            ->method('getIdErpDeliveryNote')
            ->willReturn($idErpDeliveryNote);

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->erpDeliveryNoteTransferMock, (string)$idErpDeliveryNote)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpDeliveryNoteApi->create($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testCreateWithError(): void
    {
        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('createErpDeliveryNote')
            ->willReturn($this->erpDeliveryNoteResponseTransferMock);

        $this->erpDeliveryNoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErpDeliveryNote')
            ->willReturn(null);

        $this->erpDeliveryNoteResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->erpDeliveryNoteTransferMock->expects(static::never())
            ->method('getIdErpDeliveryNote');

        $this->apiFacadeMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->erpDeliveryNoteApi->create($this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $idErpDeliveryNote = 1;
        $data = [];

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('findErpDeliveryNoteByIdErpDeliveryNote')
            ->with($idErpDeliveryNote)
            ->willReturn($this->erpDeliveryNoteTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->erpDeliveryNoteTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with($data, true)
            ->willReturn($this->erpDeliveryNoteTransferMock);

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('updateErpDeliveryNote')
            ->willReturn($this->erpDeliveryNoteResponseTransferMock);

        $this->erpDeliveryNoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErpDeliveryNote')
            ->willReturn($this->erpDeliveryNoteTransferMock);

        $this->erpDeliveryNoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->erpDeliveryNoteTransferMock->expects(static::atLeastOnce())
            ->method('getIdErpDeliveryNote')
            ->willReturn($idErpDeliveryNote);

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->erpDeliveryNoteTransferMock, (string)$idErpDeliveryNote)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpDeliveryNoteApi->update($idErpDeliveryNote, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateWithError(): void
    {
        $idErpDeliveryNote = 1;
        $data = [];

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('findErpDeliveryNoteByIdErpDeliveryNote')
            ->with($idErpDeliveryNote)
            ->willReturn($this->erpDeliveryNoteTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($data);

        $this->erpDeliveryNoteTransferMock->expects(static::atLeastOnce())
            ->method('fromArray')
            ->with($data, true)
            ->willReturn($this->erpDeliveryNoteTransferMock);

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('updateErpDeliveryNote')
            ->willReturn($this->erpDeliveryNoteResponseTransferMock);

        $this->erpDeliveryNoteResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErpDeliveryNote')
            ->willReturn(null);

        $this->erpDeliveryNoteResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->erpDeliveryNoteTransferMock->expects(static::never())
            ->method('getIdErpDeliveryNote');

        $this->apiFacadeMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->erpDeliveryNoteApi->update($idErpDeliveryNote, $this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $idErpDeliveryNote = 1;

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('findErpDeliveryNoteByIdErpDeliveryNote')
            ->with($idErpDeliveryNote)
            ->willReturn($this->erpDeliveryNoteTransferMock);

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('deleteErpDeliveryNoteByIdErpDeliveryNote')
            ->with($idErpDeliveryNote);

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with(null, (string)$idErpDeliveryNote)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpDeliveryNoteApi->delete($idErpDeliveryNote),
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $idErpDeliveryNote = 1;

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('findErpDeliveryNoteByIdErpDeliveryNote')
            ->with($idErpDeliveryNote)
            ->willReturn($this->erpDeliveryNoteTransferMock);

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->erpDeliveryNoteTransferMock, (string)$idErpDeliveryNote)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpDeliveryNoteApi->get($idErpDeliveryNote),
        );
    }

    /**
     * @return void
     */
    public function testGetWithNotExistingErpDeliveryNote(): void
    {
        $idErpDeliveryNote = 2;

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('findErpDeliveryNoteByIdErpDeliveryNote')
            ->with($idErpDeliveryNote)
            ->willReturn(null);

        try {
            $this->erpDeliveryNoteApi->get($idErpDeliveryNote);
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
                'id_erp_delivery_note' => 1,
            ],
            [],
        ];

        $data = [
            'id_erp_delivery_note' => 1,
            'foo' => 'bar',
        ];

        $this->erpDeliveryNoteApiRepositoryMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($apiCollectionTransferData);

        $this->erpDeliveryNoteFacadeMock->expects(static::atLeastOnce())
            ->method('findErpDeliveryNoteByIdErpDeliveryNote')
            ->with($apiCollectionTransferData[0]['id_erp_delivery_note'])
            ->willReturn($this->erpDeliveryNoteTransferMock);

        $this->erpDeliveryNoteTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('setData')
            ->with(
                static::callback(
                    static function (array $newData) use ($data) {
                        return count($newData) === 1
                            && isset($newData[0]['id_erp_delivery_note'], $newData[0]['foo'])
                            && $newData[0]['id_erp_delivery_note'] === $data['id_erp_delivery_note']
                            && $newData[0]['foo'] === $data['foo'];
                    },
                ),
            )->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->erpDeliveryNoteApi->find($this->apiRequestTransferMock),
        );
    }
}
