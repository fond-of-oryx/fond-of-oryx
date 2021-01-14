<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPostSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface;
use Generated\Shared\Transfer\ErpOrderTransfer;

class ErpOrderPluginExecutorTest extends Unit
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
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
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

        $this->erpOrderTransferMock = $this->getMockBuilder(ErpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->preSavePluginMock = $this->getMockBuilder(ErpOrderPreSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postSavePluginMock = $this->getMockBuilder(ErpOrderPostSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->once())->method('postSave')->willReturn($this->erpOrderTransferMock);
        $this->preSavePluginMock->expects($this->never())->method('preSave')->willReturn($this->erpOrderTransferMock);

        $pluginExecutor = new ErpOrderPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePostSavePlugins($this->erpOrderTransferMock);
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->postSavePluginMock->expects($this->never())->method('postSave')->willReturn($this->erpOrderTransferMock);
        $this->preSavePluginMock->expects($this->once())->method('preSave')->willReturn($this->erpOrderTransferMock);

        $pluginExecutor = new ErpOrderPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
        $pluginExecutor->executePreSavePlugins($this->erpOrderTransferMock);
    }
}
