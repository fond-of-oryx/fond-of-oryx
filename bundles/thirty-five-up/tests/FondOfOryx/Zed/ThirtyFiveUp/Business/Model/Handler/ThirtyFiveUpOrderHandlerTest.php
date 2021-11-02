<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Handler;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Mapper\ThirtyFiveUpOrderMapper;
use FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Writer\ThirtyFiveUpOrderWriter;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

class ThirtyFiveUpOrderHandlerTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Writer\ThirtyFiveUpOrderWriterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderWriterMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Mapper\ThirtyFiveUpOrderMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderMapperMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\SaveOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $saveOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpOrderTransferMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Handler\ThirtyFiveUpOrderHandlerInterface
     */
    protected $handler;

    /**
     * @return void
     */
    public function _before(): void
    {
        parent::_before();

        $this->orderWriterMock = $this
            ->getMockBuilder(ThirtyFiveUpOrderWriter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderMapperMock = $this
            ->getMockBuilder(ThirtyFiveUpOrderMapper::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this
            ->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->saveOrderTransferMock = $this
            ->getMockBuilder(SaveOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpOrderTransferMock = $this
            ->getMockBuilder(ThirtyFiveUpOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->handler = new ThirtyFiveUpOrderHandler(
            $this->orderMapperMock,
            $this->orderWriterMock,
        );
    }

    /**
     * @return void
     */
    public function testHandleFromQuote(): void
    {
        $this->orderMapperMock->expects($this->once())->method('fromQuote')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->orderWriterMock->expects($this->once())->method('create')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->quoteTransferMock->expects($this->once())->method('setThirtyFiveUpOrder');

        $this->handler->handleFromQuote($this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleFromQuoteWithNoData(): void
    {
        $this->orderMapperMock->expects($this->once())->method('fromQuote');
        $this->orderWriterMock->expects($this->never())->method('create');
        $this->quoteTransferMock->expects($this->never())->method('setThirtyFiveUpOrder');

        $this->handler->handleFromQuote($this->quoteTransferMock);
    }

    /**
     * @return void
     */
    public function testHandleFromSavedOrder(): void
    {
        $this->orderMapperMock->expects($this->once())->method('fromSavedOrder')->willReturn($this->thirtyFiveUpOrderTransferMock);
        $this->orderWriterMock->expects($this->once())->method('update')->willReturn($this->thirtyFiveUpOrderTransferMock);

        $this->handler->handleFromSavedOrder($this->saveOrderTransferMock, $this->thirtyFiveUpOrderTransferMock);
    }
}
