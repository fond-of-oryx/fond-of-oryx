<?php

namespace FondOfOryx\Zed\ErpInvoiceApi\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeInterface;
use FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer\ErpInvoiceApiToApiQueryContainerInterface;
use FondOfOryx\Zed\ErpInvoiceApi\Persistence\ErpInvoiceApiRepositoryInterface;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;
use Generated\Shared\Transfer\ErpInvoiceResponseTransfer;
use Generated\Shared\Transfer\ErpInvoiceTransfer;

class ErpInvoiceApiTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Dependency\QueryContainer\ErpInvoiceApiToApiQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiQueryContainerMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Dependency\Facade\ErpInvoiceApiToErpInvoiceFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpInvoiceResponseTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceResponseTransferMock;

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
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Persistence\ErpInvoiceApiRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpInvoiceApiRepositoryMock;

    /**
     * @var \Generated\Shared\Transfer\ApiCollectionTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiCollectionTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpInvoiceApi\Business\Model\ErpInvoiceApi
     */
    protected $erpInvoiceApi;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiQueryContainerMock = $this->getMockBuilder(ErpInvoiceApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceFacadeMock = $this->getMockBuilder(ErpInvoiceApiToErpInvoiceFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceTransferMock = $this->getMockBuilder(ErpInvoiceTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceResponseTransferMock = $this->getMockBuilder(ErpInvoiceResponseTransfer::class)
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

        $this->erpInvoiceApiRepositoryMock = $this->getMockBuilder(ErpInvoiceApiRepositoryInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpInvoiceApi = new ErpInvoiceApi(
            $this->apiQueryContainerMock,
            $this->erpInvoiceFacadeMock,
            $this->erpInvoiceApiRepositoryMock,
        );
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $idErpInvoice = 1;

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('createErpInvoice')
            ->willReturn($this->erpInvoiceResponseTransferMock);

        $this->erpInvoiceResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErpInvoice')
            ->willReturn($this->erpInvoiceTransferMock);

        $this->erpInvoiceResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->erpInvoiceTransferMock->expects(static::atLeastOnce())
            ->method('getIdErpInvoice')
            ->willReturn($idErpInvoice);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->erpInvoiceTransferMock, $idErpInvoice)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApi->create($this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testCreateWithError(): void
    {
        $idErpInvoice = 1;

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('createErpInvoice')
            ->willReturn($this->erpInvoiceResponseTransferMock);

        $this->erpInvoiceResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErpInvoice')
            ->willReturn(null);

        $this->erpInvoiceResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->erpInvoiceTransferMock->expects(static::never())
            ->method('getIdErpInvoice');

        $this->apiQueryContainerMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->erpInvoiceApi->create($this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $idErpInvoice = 1;

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('findErpInvoiceByIdErpInvoice')
            ->with($idErpInvoice)
            ->willReturn($this->erpInvoiceTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('updateErpInvoice')
            ->willReturn($this->erpInvoiceResponseTransferMock);

        $this->erpInvoiceResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErpInvoice')
            ->willReturn($this->erpInvoiceTransferMock);

        $this->erpInvoiceResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccessful')
            ->willReturn(true);

        $this->erpInvoiceTransferMock->expects(static::atLeastOnce())
            ->method('getIdErpInvoice')
            ->willReturn($idErpInvoice);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->erpInvoiceTransferMock, $idErpInvoice)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApi->update($idErpInvoice, $this->apiDataTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateWithError(): void
    {
        $idErpInvoice = 1;

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('findErpInvoiceByIdErpInvoice')
            ->with($idErpInvoice)
            ->willReturn($this->erpInvoiceTransferMock);

        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn([]);

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('updateErpInvoice')
            ->willReturn($this->erpInvoiceResponseTransferMock);

        $this->erpInvoiceResponseTransferMock->expects(static::atLeastOnce())
            ->method('getErpInvoice')
            ->willReturn(null);

        $this->erpInvoiceResponseTransferMock->expects(static::never())
            ->method('getIsSuccessful');

        $this->erpInvoiceTransferMock->expects(static::never())
            ->method('getIdErpInvoice');

        $this->apiQueryContainerMock->expects(static::never())
            ->method('createApiItem');

        try {
            $this->erpInvoiceApi->update($idErpInvoice, $this->apiDataTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $idErpInvoice = 1;

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('findErpInvoiceByIdErpInvoice')
            ->with($idErpInvoice)
            ->willReturn($this->erpInvoiceTransferMock);

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('deleteErpInvoiceByIdErpInvoice')
            ->with($idErpInvoice);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with(new ErpInvoiceTransfer(), $idErpInvoice)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApi->delete($idErpInvoice),
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $idErpInvoice = 1;

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('findErpInvoiceByIdErpInvoice')
            ->with($idErpInvoice)
            ->willReturn($this->erpInvoiceTransferMock);

        $this->apiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->with($this->erpInvoiceTransferMock, $idErpInvoice)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpInvoiceApi->get($idErpInvoice),
        );
    }

    /**
     * @return void
     */
    public function testGetWithNotExistingErpInvoice(): void
    {
        $idErpInvoice = 2;

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('findErpInvoiceByIdErpInvoice')
            ->with($idErpInvoice)
            ->willReturn(null);

        try {
            $this->erpInvoiceApi->get($idErpInvoice);
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
                'id_erp_invoice' => 1,
            ],
            [],
        ];

        $data = [
            'id_erp_invoice' => 1,
            'foo' => 'bar',
        ];

        $this->erpInvoiceApiRepositoryMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn($apiCollectionTransferData);

        $this->erpInvoiceFacadeMock->expects(static::atLeastOnce())
            ->method('findErpInvoiceByIdErpInvoice')
            ->with($apiCollectionTransferData[0]['id_erp_invoice'])
            ->willReturn($this->erpInvoiceTransferMock);

        $this->erpInvoiceTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($data);

        $this->apiCollectionTransferMock->expects(static::atLeastOnce())
            ->method('setData')
            ->with(
                static::callback(
                    static function (array $newData) use ($data) {
                        return count($newData) === 1
                            && isset($newData[0]['id_erp_invoice'], $newData[0]['foo'])
                            && $newData[0]['id_erp_invoice'] === $data['id_erp_invoice']
                            && $newData[0]['foo'] === $data['foo'];
                    },
                ),
            )->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->erpInvoiceApi->find($this->apiRequestTransferMock),
        );
    }
}
