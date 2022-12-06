<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutor;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManager;
use Generated\Shared\Transfer\ErpOrderItemTransfer;

class ErpOrderItemWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderItemPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pluginExecutorMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderItemTransfer;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderItemWriterInterface
     */
    protected $writer;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(ErpOrderEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pluginExecutorMock = $this->getMockBuilder(ErpOrderItemPluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderItemTransfer = $this->getMockBuilder(ErpOrderItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->writer = new ErpOrderItemWriter(
            $this->entityManagerMock,
            $this->pluginExecutorMock,
        );
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->entityManagerMock->expects($this->once())->method('createErpOrderItem')->willReturn($this->erpOrderItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpOrderItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpOrderItemTransfer);

        $result = $this->writer->create($this->erpOrderItemTransfer);

        $this->assertInstanceOf(ErpOrderItemTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testCreateNotSuccesful(): void
    {
        $this->entityManagerMock->expects($this->once())->method('createErpOrderItem')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpOrderItemTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpOrderItemTransfer);

        $catch = null;
        try {
            $this->writer->create($this->erpOrderItemTransfer);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertSame('test', $catch->getMessage());
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->entityManagerMock->expects($this->once())->method('updateErpOrderItem')->willReturn($this->erpOrderItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpOrderItemTransfer);
        $this->pluginExecutorMock->expects($this->once())->method('executePostSavePlugins')->willReturn($this->erpOrderItemTransfer);
        $this->erpOrderItemTransfer->expects($this->once())->method('requireIdErpOrderItem')->willReturn($this->erpOrderItemTransfer);
        $this->erpOrderItemTransfer->expects($this->once())->method('requireFkErpOrder')->willReturn($this->erpOrderItemTransfer);

        $result = $this->writer->update($this->erpOrderItemTransfer);

        $this->assertInstanceOf(ErpOrderItemTransfer::class, $result);
    }

    /**
     * @return void
     */
    public function testUpdateNotSuccesful(): void
    {
        $this->erpOrderItemTransfer->expects($this->once())->method('requireIdErpOrderItem')->willReturn($this->erpOrderItemTransfer);
        $this->erpOrderItemTransfer->expects($this->once())->method('requireFkErpOrder')->willReturn($this->erpOrderItemTransfer);
        $this->entityManagerMock->expects($this->once())->method('updateErpOrderItem')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $this->pluginExecutorMock->expects($this->once())->method('executePreSavePlugins')->willReturn($this->erpOrderItemTransfer);
        $this->pluginExecutorMock->expects($this->never())->method('executePostSavePlugins')->willReturn($this->erpOrderItemTransfer);

        $catch = null;
        try {
            $this->writer->update($this->erpOrderItemTransfer);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertSame('test', $catch->getMessage());
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->entityManagerMock->expects($this->once())->method('deleteErpOrderItemByIdErpOrderItem');

        $this->writer->delete(1);
    }

    /**
     * @return void
     */
    public function testDeleteWillThrowException(): void
    {
        $this->entityManagerMock->expects($this->once())->method('deleteErpOrderItemByIdErpOrderItem')->will($this->returnCallback(static function () {
            throw new Exception('test');
        }));
        $catch = null;
        try {
            $this->writer->delete(1);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        $this->assertNotNull($catch);
        $this->assertSame('test', $catch->getMessage());
    }
}
