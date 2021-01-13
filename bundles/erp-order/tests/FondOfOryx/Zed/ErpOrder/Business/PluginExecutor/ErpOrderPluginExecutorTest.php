<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPostSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPreSavePluginInterface;
use Generated\Shared\Transfer\ErpOrderItemTransfer;

class ErpOrderItemPluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderItemPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $postSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface
     */
    protected $pluginExecutor;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpOrderItemTransferMock = $this->getMockBuilder(ErpOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->preSavePluginMock = $this->getMockBuilder(ErpOrderItemPreSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postSavePluginMock = $this->getMockBuilder(ErpOrderItemPostSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->once())->method('postSave')->willReturn($this->erpOrderItemTransferMock);
        $this->preSavePluginMock->expects($this->never())->method('preSave')->willReturn($this->erpOrderItemTransferMock);

        $pluginExecutor = new ErpOrderItemPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePostSavePlugins($this->erpOrderItemTransferMock);
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->never())->method('postSave')->willReturn($this->erpOrderItemTransferMock);
        $this->preSavePluginMock->expects($this->once())->method('preSave')->willReturn($this->erpOrderItemTransferMock);

        $pluginExecutor = new ErpOrderItemPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePreSavePlugins($this->erpOrderItemTransferMock);
    }
}
