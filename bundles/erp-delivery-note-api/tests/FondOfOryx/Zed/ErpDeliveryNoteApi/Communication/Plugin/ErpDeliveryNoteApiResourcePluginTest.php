<?php

namespace FondOfOryx\Zed\ErpDeliveryNoteApi\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Business\ErpDeliveryNoteApiFacade;
use FondOfOryx\Zed\ErpDeliveryNoteApi\Communication\Plugin\Api\ErpDeliveryNoteApiResourcePlugin;
use FondOfOryx\Zed\ErpDeliveryNoteApi\ErpDeliveryNoteApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ErpDeliveryNoteApiResourcePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpDeliveryNoteApi\Business\ErpDeliveryNoteApiFacade
     */
    protected $erpDeliveryNoteApiFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \FondOfOryx\Zed\ErpDeliveryNoteApi\Communication\Plugin\Api\ErpDeliveryNoteApiResourcePlugin
     */
    protected $erpDeliveryNoteApiResourcePlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpDeliveryNoteApiFacadeMock = $this->getMockBuilder(ErpDeliveryNoteApiFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->id = 1;

        $this->erpDeliveryNoteApiResourcePlugin = new ErpDeliveryNoteApiResourcePlugin();
        $this->erpDeliveryNoteApiResourcePlugin->setFacade($this->erpDeliveryNoteApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertSame(
            ErpDeliveryNoteApiConfig::RESOURCE_ERP_DELIVERY_NOTES,
            $this->erpDeliveryNoteApiResourcePlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->erpDeliveryNoteApiFacadeMock->expects(static::atLeastOnce())
            ->method('createErpDeliveryNote')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpDeliveryNoteApiResourcePlugin->add(
                $this->apiDataTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->erpDeliveryNoteApiFacadeMock->expects(static::atLeastOnce())
            ->method('getErpDeliveryNote')
            ->with($this->id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpDeliveryNoteApiResourcePlugin->get(
                $this->id,
            ),
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->erpDeliveryNoteApiFacadeMock->expects(static::atLeastOnce())
            ->method('updateErpDeliveryNote')
            ->with($this->id, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpDeliveryNoteApiResourcePlugin->update(
                $this->id,
                $this->apiDataTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testRemove(): void
    {
        $this->erpDeliveryNoteApiFacadeMock->expects(static::atLeastOnce())
            ->method('deleteErpDeliveryNote')
            ->with($this->id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpDeliveryNoteApiResourcePlugin->remove(
                $this->id,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->erpDeliveryNoteApiFacadeMock->expects(static::atLeastOnce())
            ->method('findErpDeliveryNotes')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->erpDeliveryNoteApiResourcePlugin->find(
                $this->apiRequestTransferMock,
            ),
        );
    }
}
