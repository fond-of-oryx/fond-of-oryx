<?php

namespace FondOfOryx\Zed\SplittableTotalsRestApi\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableTotalsRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

class QuoteExpanderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject[]|\FondOfOryx\Zed\SplittableTotalsRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface[]
     */
    protected $quoteExpanderPluginMocks;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableTotalsRestApi\Business\Expander\QuoteExpander
     */
    protected $quoteExpander;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteExpanderPluginMocks = [
            $this->getMockBuilder(QuoteExpanderPluginInterface::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteExpander = new QuoteExpander($this->quoteExpanderPluginMocks);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->quoteExpanderPluginMocks[0]->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restSplittableTotalsRequestTransferMock, $this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->restSplittableTotalsRequestTransferMock, $this->quoteTransferMock)
        );
    }
}
