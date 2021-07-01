<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPostSavePluginInterface;
use FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPreSavePluginInterface;
use Generated\Shared\Transfer\CreditMemoTransfer;

class CreditMemoPluginExecutorTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPostSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $postSavePluginMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemoExtension\Dependency\Plugin\CreditMemoPreSavePluginInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $preSavePluginMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoTransferMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoPluginExecutorInterface
     */
    protected $model;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->postSavePluginMock = $this->getMockBuilder(CreditMemoPostSavePluginInterface::class)->disableOriginalConstructor()->getMock();
        $this->preSavePluginMock = $this->getMockBuilder(CreditMemoPreSavePluginInterface::class)->disableOriginalConstructor()->getMock();
        $this->creditMemoTransferMock = $this->getMockBuilder(CreditMemoTransfer::class)->disableOriginalConstructor()->getMock();

        $this->model = new CreditMemoPluginExecutor([$this->preSavePluginMock], [$this->postSavePluginMock]);
    }

    /**
     * @return void
     */
    public function testExecutePostSavePlugins(): void
    {
        $this->postSavePluginMock->expects(static::once())->method('postSave')->willReturn($this->creditMemoTransferMock);
        $this->preSavePluginMock->expects(static::never())->method('preSave');

        $this->model->executePostSavePlugins($this->creditMemoTransferMock);
    }

    /**
     * @return void
     */
    public function testExecutePreSavePlugins(): void
    {
        $this->preSavePluginMock->expects(static::once())->method('preSave')->willReturn($this->creditMemoTransferMock);
        $this->postSavePluginMock->expects(static::never())->method('postSave');

        $this->model->executePreSavePlugins($this->creditMemoTransferMock);
    }
}
