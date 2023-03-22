<?php

namespace FondOfOryx\Zed\ErpOrder\Communication\Plugin\PostSave;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacade;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderTotalPersistorErpOrderPostSavePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPostSavePluginInterface
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

        $this->erpOrderFacadeMock = $this->getMockBuilder(ErpOrderFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ErpOrderTotalPersistorErpOrderPostSavePlugin();
        $this->plugin->setFacade($this->erpOrderFacadeMock);
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->erpOrderFacadeMock->expects($this->once())
            ->method('persistErpOrderTotal')
            ->with($this->erpOrderTransferMock)
            ->willReturn($this->erpOrderTransferMock);

        $erpOrderTransfer = $this->plugin->postSave($this->erpOrderTransferMock);

        $this->assertInstanceOf(
            ErpOrderTransfer::class,
            $erpOrderTransfer,
        );
    }
}
