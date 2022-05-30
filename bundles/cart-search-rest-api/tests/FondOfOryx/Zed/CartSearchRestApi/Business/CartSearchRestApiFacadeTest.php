<?php

namespace FondOfOryx\Zed\CartSearchRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CartSearchRestApi\Business\Reader\QuoteReaderInterface;
use Generated\Shared\Transfer\QuoteListTransfer;

class CartSearchRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Business\CartSearchRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Business\Reader\QuoteReaderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteReaderMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CartSearchRestApi\Business\CartSearchRestApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CartSearchRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteReaderMock = $this->getMockBuilder(QuoteReaderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteListTransferMock = $this->getMockBuilder(QuoteListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CartSearchRestApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindQuotes(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createQuoteReader')
            ->willReturn($this->quoteReaderMock);

        $this->quoteReaderMock->expects(static::atLeastOnce())
            ->method('findByQuoteList')
            ->with($this->quoteListTransferMock)
            ->willReturn($this->quoteListTransferMock);

        static::assertEquals(
            $this->quoteListTransferMock,
            $this->facade->findQuotes($this->quoteListTransferMock),
        );
    }
}
