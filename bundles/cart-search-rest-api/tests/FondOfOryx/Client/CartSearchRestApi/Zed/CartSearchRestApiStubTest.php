<?php

namespace FondOfOryx\Client\CartSearchRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\CartSearchRestApi\Dependency\Client\CartSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\QuoteListTransfer;

class CartSearchRestApiStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteListTransferMock;

    /**
     * @var \FondOfOryx\Client\CartSearchRestApi\Dependency\Client\CartSearchRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CartSearchRestApi\Zed\CartSearchRestApiStub
     */
    protected $priceListStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteListTransferMock = $this->getMockBuilder(QuoteListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CartSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->priceListStub = new CartSearchRestApiStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testFindCartSearchRestApis(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                CartSearchRestApiStub::URL_FIND_QUOTES,
                $this->quoteListTransferMock,
            )->willReturn($this->quoteListTransferMock);

        static::assertEquals(
            $this->quoteListTransferMock,
            $this->priceListStub->findQuotes($this->quoteListTransferMock),
        );
    }
}
