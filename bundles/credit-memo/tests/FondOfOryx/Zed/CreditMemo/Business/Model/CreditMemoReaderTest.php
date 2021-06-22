<?php

namespace FondOfOryx\Zed\CreditMemo\Business\Model;

use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepository;
use Orm\Zed\CreditMemo\Persistence\FooCreditMemo;
use Orm\Zed\Sales\Persistence\SpySalesOrderItem;

class CreditMemoReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \Orm\Zed\CreditMemo\Persistence\FooCreditMemo|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $fooCreditMemoMock;

    /**
     * @var \Orm\Zed\Sales\Persistence\SpySalesOrderItem|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spySalesOrderItemTransferMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemo\Business\Model\CreditMemoReaderInterface
     */
    protected $model;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CreditMemoRepository::class)->disableOriginalConstructor()->getMock();
        $this->fooCreditMemoMock = $this->getMockBuilder(FooCreditMemo::class)->disableOriginalConstructor()->getMock();
        $this->spySalesOrderItemTransferMock = $this->getMockBuilder(SpySalesOrderItem::class)->disableOriginalConstructor()->getMock();

        $this->model = new CreditMemoReader($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testGetCreditMemoBySalesOrderItems(): void
    {
        $this->repositoryMock->expects(static::once())->method('findCreditMemoByFkSalesOrderItem')->willReturn($this->fooCreditMemoMock);

        $creditMemos = $this->model->getCreditMemoBySalesOrderItems([$this->spySalesOrderItemTransferMock]);

        static::assertCount(1, $creditMemos);
    }

    /**
     * @return void
     */
    public function testGetCreditMemoBySalesOrderItemsWithNoCreditMemoFoundException(): void
    {
        $this->repositoryMock->expects(static::once())->method('findCreditMemoByFkSalesOrderItem')->willReturn(null);
        $this->spySalesOrderItemTransferMock->expects(static::once())->method('getIdSalesOrderItem')->willReturn(1);

        $catch = null;
        try {
            $this->model->getCreditMemoBySalesOrderItems([$this->spySalesOrderItemTransferMock]);
        } catch (Exception $exception) {
            $catch = $exception;
        }

        static::assertNotNull($catch);
        static::assertSame('No CreditMemo found for ids 1', $catch->getMessage());
    }
}
