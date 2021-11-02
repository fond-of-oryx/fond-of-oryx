<?php

namespace FondOfOryx\Zed\ErpOrderApi\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderApi\Business\ErpOrderApiFacade;
use FondOfOryx\Zed\ErpOrderApi\Communication\Plugin\Api\ErpOrderApiResourcePlugin;
use FondOfOryx\Zed\ErpOrderApi\ErpOrderApiConfig;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class ErpOrderApiResourcePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\ErpOrderApi\Business\ErpOrderApiFacade
     */
    protected $erpOrderApiFacadeMock;

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
     * @var \FondOfOryx\Zed\ErpOrderApi\Communication\Plugin\Api\ErpOrderApiResourcePlugin
     */
    protected $erpOrderApiResourcePlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->erpOrderApiFacadeMock = $this->getMockBuilder(ErpOrderApiFacade::class)
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

        $this->erpOrderApiResourcePlugin = new ErpOrderApiResourcePlugin();
        $this->erpOrderApiResourcePlugin->setFacade($this->erpOrderApiFacadeMock);
    }

    /**
     * @return void
     */
    public function testGetResourceName(): void
    {
        static::assertSame(
            ErpOrderApiConfig::RESOURCE_ERP_ORDERS,
            $this->erpOrderApiResourcePlugin->getResourceName(),
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->erpOrderApiFacadeMock->expects(static::atLeastOnce())
            ->method('createErpOrder')
            ->with($this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpOrderApiResourcePlugin->add(
                $this->apiDataTransferMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGet(): void
    {
        $this->erpOrderApiFacadeMock->expects(static::atLeastOnce())
            ->method('getErpOrder')
            ->with($this->id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpOrderApiResourcePlugin->get(
                $this->id,
            ),
        );
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->erpOrderApiFacadeMock->expects(static::atLeastOnce())
            ->method('updateErpOrder')
            ->with($this->id, $this->apiDataTransferMock)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpOrderApiResourcePlugin->update(
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
        $this->erpOrderApiFacadeMock->expects(static::atLeastOnce())
            ->method('deleteErpOrder')
            ->with($this->id)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->erpOrderApiResourcePlugin->remove(
                $this->id,
            ),
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $this->erpOrderApiFacadeMock->expects(static::atLeastOnce())
            ->method('findErpOrders')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->erpOrderApiResourcePlugin->find(
                $this->apiRequestTransferMock,
            ),
        );
    }
}
