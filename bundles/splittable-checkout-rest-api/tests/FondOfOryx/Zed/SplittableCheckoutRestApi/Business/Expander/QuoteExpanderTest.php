<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Expander;

use Codeception\Test\Unit;
use FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class QuoteExpanderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject[]|\FondOfOryx\Zed\SplittableCheckoutRestApiExtension\Dependency\Plugin\QuoteExpanderPluginInterface[]
     */
    protected $quoteExpanderPluginMocks;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApi\Business\Expander\QuoteExpander
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

        $this->restSplittableCheckoutRequestTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestTransfer::class)
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
            ->with($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->quoteExpander->expand($this->restSplittableCheckoutRequestTransferMock, $this->quoteTransferMock)
        );
    }
}
