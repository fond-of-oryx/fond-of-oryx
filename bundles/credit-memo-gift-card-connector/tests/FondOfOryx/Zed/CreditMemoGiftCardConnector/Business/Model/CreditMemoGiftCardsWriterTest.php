<?php

namespace FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\CreditMemoGiftCardTransfer;
use Generated\Shared\Transfer\CreditMemoTransfer;

class CreditMemoGiftCardsWriterTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CreditMemoTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoGiftCardTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoGiftCardTransferMock;

    /**
     * @var \Generated\Shared\Transfer\CreditMemoGiftCardTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $creditMemoGiftCardWriterMock;

    /**
     * @var \FondOfOryx\Zed\CreditMemoGiftCardConnector\Business\Model\CreditMemoGiftCardsWriterInterface
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->creditMemoTransferMock = $this
            ->getMockBuilder(CreditMemoTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->creditMemoGiftCardTransferMock = $this
            ->getMockBuilder(CreditMemoGiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->creditMemoGiftCardWriterMock = $this
            ->getMockBuilder(CreditMemoGiftCardWriterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new CreditMemoGiftCardsWriter($this->creditMemoGiftCardWriterMock);
    }

    /**
     * @return void
     */
    public function testCreate(): void
    {
        $idCreditMemo = 1;
        $creditMemoGiftCards = new ArrayObject();
        $creditMemoGiftCards->append($this->creditMemoGiftCardTransferMock);

        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('getIdCreditMemo')
            ->willReturn($idCreditMemo);

        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('getGiftCards')
            ->willReturn($creditMemoGiftCards);

        $this->creditMemoGiftCardTransferMock->expects(static::atLeastOnce())
            ->method('setFkCreditMemo')
            ->with($idCreditMemo)
            ->willReturnSelf();

        $this->creditMemoGiftCardWriterMock->expects(static::atLeastOnce())
            ->method('create')
            ->with($this->creditMemoGiftCardTransferMock)
            ->willReturn($this->creditMemoGiftCardTransferMock);

        $this->creditMemoTransferMock->expects(static::atLeastOnce())
            ->method('setGiftCards')
            ->willReturnSelf();

        $creditMemoTransfer = $this->model->create($this->creditMemoTransferMock);

        static::assertInstanceOf(CreditMemoTransfer::class, $creditMemoTransfer);

        static::assertEquals(1, $creditMemoTransfer->getGiftCards()->count());
    }
}
