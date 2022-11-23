<?php

namespace FondOfOryx\Zed\ErpOrder\Business\Model\Writer;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutor;
use FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManager;
use Generated\Shared\Transfer\ErpOrderTotalsTransfer;

class ErpOrderTotalsWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ErpOrder\Persistence\ErpOrderEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\PluginExecutor\ErpOrderTotalsPluginExecutorInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $pluginExecutorMock;

    /**
     * @var \Generated\Shared\Transfer\ErpOrderTotalsTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $erpOrderTotalsTransferMock;

    /**
     * @var \FondOfOryx\Zed\ErpOrder\Business\Model\Writer\ErpOrderTotalsWriterInterface
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

        $this->pluginExecutorMock = $this->getMockBuilder(ErpOrderTotalsPluginExecutor::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->erpOrderTotalsTransferMock = $this->getMockBuilder(ErpOrderTotalsTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->writer = new ErpOrderTotalsWriter(
            $this->entityManagerMock,
            $this->pluginExecutorMock,
        );
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePreSavePlugins')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createErpOrderTotals')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePostSavePlugins')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        static::assertEquals(
            $this->erpOrderTotalsTransferMock,
            $this->writer->create($this->erpOrderTotalsTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testCreateNotSuccessful(): void
    {
        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePreSavePlugins')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('createErpOrderTotals')
            ->with($this->erpOrderTotalsTransferMock)
            ->willThrowException(new Exception());

        $this->pluginExecutorMock->expects(static::never())
            ->method('executePostSavePlugins');

        try {
            $this->writer->create($this->erpOrderTotalsTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testUpdate(): void
    {
        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePreSavePlugins')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateErpOrderTotals')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePostSavePlugins')
            ->with($this->erpOrderTotalsTransferMock)
            ->willReturn($this->erpOrderTotalsTransferMock);

        static::assertEquals(
            $this->erpOrderTotalsTransferMock,
            $this->writer->update($this->erpOrderTotalsTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testUpdateNotSuccessful(): void
    {
        $this->pluginExecutorMock->expects(static::atLeastOnce())
            ->method('executePreSavePlugins')
            ->willReturn($this->erpOrderTotalsTransferMock);

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('updateErpOrderTotals')
            ->willThrowException(new Exception());

        $this->pluginExecutorMock->expects(static::never())
            ->method('executePostSavePlugins');

        try {
            $this->writer->update($this->erpOrderTotalsTransferMock);
            static::fail();
        } catch (Exception $exception) {
        }
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $idErpOrderTotals = 1;

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deleteErpOrderTotalsByIdErpOrderTotals')
            ->with($idErpOrderTotals);

        $this->writer->delete($idErpOrderTotals);
    }

    /**
     * @return void
     */
    public function testDeleteNotSuccessful(): void
    {
        $idErpOrderTotals = 1;

        $this->entityManagerMock->expects(static::atLeastOnce())
            ->method('deleteErpOrderTotalsByIdErpOrderTotals')
            ->with($idErpOrderTotals)
            ->willThrowException(new Exception());

        try {
            $this->writer->delete($idErpOrderTotals);
            static::fail();
        } catch (Exception $exception) {
        }
    }
}
