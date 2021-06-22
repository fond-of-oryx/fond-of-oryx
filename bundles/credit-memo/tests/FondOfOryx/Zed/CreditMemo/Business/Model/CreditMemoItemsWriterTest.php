<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManager;
use Generated\Shared\Transfer\CreditMemoTransfer;
use Generated\Shared\Transfer\ItemTransfer;

class CreditMemoItemsWriterTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoEntityManagerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ItemTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoItemsWriterInterface
     */
    protected $model;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->entityManagerMock = $this->getMockBuilder(CreditMemoEntityManager::class)->disableOriginalConstructor()->getMock();
        $this->creditMemoTransferMock = $this->getMockBuilder(CreditMemoTransfer::class)->disableOriginalConstructor()->getMock();
        $this->creditMemoItemTransferMock = $this->getMockBuilder(ItemTransfer::class)->disableOriginalConstructor()->getMock();

        $this->model = new CreditMemoItemsWriter($this->entityManagerMock);
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $this->creditMemoTransferMock->expects(static::once())->method('requireIdCreditMemo')->willReturn($this->creditMemoTransferMock);
        $this->creditMemoTransferMock->expects(static::once())->method('requireItems')->willReturn($this->creditMemoTransferMock);
        $this->creditMemoTransferMock->expects(static::once())->method('getIdCreditMemo')->willReturn(1);
        $this->creditMemoTransferMock->expects(static::once())->method('getItems')->willReturn([$this->creditMemoItemTransferMock]);
        $this->creditMemoItemTransferMock->expects(static::once())->method('setFkCreditMemo')->willReturn($this->creditMemoItemTransferMock);
        $this->entityManagerMock->expects(static::once())->method('createCreditMemoItem');

        $this->model->create($this->creditMemoTransferMock);
    }

    /**
     * @return void
     */
    public function testCreateWithoutItems(): void
    {
        $this->creditMemoTransferMock->expects(static::once())->method('requireIdCreditMemo')->willReturn($this->creditMemoTransferMock);
        $this->creditMemoTransferMock->expects(static::once())->method('requireItems')->willReturn($this->creditMemoTransferMock);
        $this->creditMemoTransferMock->expects(static::once())->method('getItems')->willReturn([]);
        $this->entityManagerMock->expects(static::never())->method('createCreditMemoItem');

        $this->model->create($this->creditMemoTransferMock);
    }
}
