<?php

namespace FondOfOryx\Zed\ErpOrder\Business\PluginExecutor;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalsPostSavePluginInterface;
use FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalsPreSavePluginInterface;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;

class ErpOrderTotalsPluginExecutorTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ErpOrderTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalsPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrderExtension\Dependency\Plugin\ErpOrderTotalsPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $postSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutor
     */
    protected $erpOrderTotalsPluginExecutor;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->erpOrderTotalsTransferMock = $this->getMockBuilder(ErpOrderTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->preSavePluginMock = $this->getMockBuilder(ErpOrderTotalsPreSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->postSavePluginMock = $this->getMockBuilder(ErpOrderTotalsPostSavePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTotalsPluginExecutor = new ErpOrderTotalsPluginExecutor(
            [$this->preSavePluginMock],
            [$this->postSavePluginMock],
        );
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects(static::atLeastOnce())
            ->method('postSave')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        static::assertEquals(
            $this->erpOrderTotalsTransferMock,
            $this->erpOrderTotalsPluginExecutor->executePostSavePlugins($this->erpOrderTotalsTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->preSavePluginMock->expects(static::atLeastOnce())
            ->method('preSave')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        static::assertEquals(
            $this->erpOrderTotalsTransferMock,
            $this->erpOrderTotalsPluginExecutor->executePreSavePlugins($this->erpOrderTotalsTransferMock),
        );
    }
}
