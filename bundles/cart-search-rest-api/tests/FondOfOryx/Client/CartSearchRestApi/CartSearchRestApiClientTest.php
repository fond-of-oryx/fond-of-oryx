<?php

namespace FondOfOryx\Client\CartSearchRestApi;

use Codeception\Test\Unit;
use FondOfOryx\Client\CartSearchRestApi\Zed\CartSearchRestApiStubInterface;
use Generated\Shared\Transfer\QuoteListTransfer;

class CartSearchRestApiClientTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\CartSearchRestApi\CartSearchRestApiFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Client\CartSearchRestApi\Zed\CartSearchRestApiStubInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedStubMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteListTransferMock;

    /**
     * @var \FondOfOryx\Client\CartSearchRestApi\CartSearchRestApiClient
     */
    protected $client;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->factoryMock = $this->getMockBuilder(CartSearchRestApiFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedStubMock = $this->getMockBuilder(CartSearchRestApiStubInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteListTransferMock = $this->getMockBuilder(QuoteListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->client = new CartSearchRestApiClient();
        $this->client->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testFindCartSearchRestApis(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createZedCartSearchRestApiStub')
            ->willReturn($this->zedStubMock);

        $this->zedStubMock->expects(static::atLeastOnce())
            ->method('findQuotes')
            ->with($this->quoteListTransferMock)
            ->willReturn($this->quoteListTransferMock);

        static::assertEquals(
            $this->quoteListTransferMock,
            $this->client->findQuotes($this->quoteListTransferMock),
        );
    }
}
