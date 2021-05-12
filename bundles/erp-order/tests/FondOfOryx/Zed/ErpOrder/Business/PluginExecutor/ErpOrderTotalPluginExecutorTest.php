<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalPostSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalPreSavePluginInterface;
use Generated\Shared\Transfer\ErpOrderTotalTransfer;

class ErpOrderTotalPluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpOrderTotalTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\ErpOrderFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderFacadeMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
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

        $this->erpOrderTotalTransferMock = $this->getMockBuilder(ErpOrderTotalTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->preSavePluginMock = $this->getMockBuilder(ErpOrderTotalPreSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postSavePluginMock = $this->getMockBuilder(ErpOrderTotalPostSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->once())->method('postSave')->willReturn($this->erpOrderTotalTransferMock);
        $this->preSavePluginMock->expects($this->never())->method('preSave')->willReturn($this->erpOrderTotalTransferMock);

        $pluginExecutor = new ErpOrderTotalPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePostSavePlugins($this->erpOrderTotalTransferMock);
    }

    /**
     * @skip
     *
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->never())->method('postSave')->willReturn($this->erpOrderTotalTransferMock);
        $this->preSavePluginMock->expects($this->once())->method('preSave')->willReturn($this->erpOrderTotalTransferMock);

        $pluginExecutor = new ErpOrderTotalPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePreSavePlugins($this->erpOrderTotalTransferMock);
    }
}
