<?php

namespace FondOfOryx\Zed\ErpOrder\Communication\Plugin\PreSave;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\ErpOrderItemTransfer;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderCalculateOutstandingQuantityErpOrderPreSavePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpOrderTransferMock = $this->getMockBuilder(ErpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderItemTransferMock = $this->getMockBuilder(ErpOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ErpOrderCalculateOutstandingQuantityErpOrderPreSavePlugin();
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('getOrderItems')
            ->willReturn([$this->erpOrderItemTransferMock]);

        $this->erpOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getOrderedQuantity')
            ->willReturn(5);

        $this->erpOrderItemTransferMock->expects(static::atLeastOnce())
            ->method('getShippedQuantity')
            ->willReturn(2);

        $this->erpOrderTransferMock->expects(static::atLeastOnce())
            ->method('setOutstandingQuantity')
            ->willReturn($this->erpOrderTransferMock);

        $this->plugin->preSave($this->erpOrderTransferMock);

        $erpOrderTransfer = $this->plugin->preSave($this->erpOrderTransferMock);
    }
}
