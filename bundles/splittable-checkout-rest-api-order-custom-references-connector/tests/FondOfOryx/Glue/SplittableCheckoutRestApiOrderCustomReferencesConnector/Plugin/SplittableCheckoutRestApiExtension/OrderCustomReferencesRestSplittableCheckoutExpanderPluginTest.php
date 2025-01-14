<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApiOrderCustomReferencesConnector\Plugin\SplittableCheckoutRestApiExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutTransfer;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;

class OrderCustomReferencesRestSplittableCheckoutExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SplittableCheckoutTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutTransferMock;

    /**
     * @var array<string, \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject>
     */
    protected $quoteTransferMocks;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApiOrderCustomReferencesConnector\Plugin\SplittableCheckoutRestApiExtension\OrderCustomReferencesRestSplittableCheckoutExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableCheckoutTransferMock = $this->getMockBuilder(SplittableCheckoutTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutTransferMock = $this->getMockBuilder(RestSplittableCheckoutTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMocks = [
            'foo' => $this->getMockBuilder(QuoteTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
            'bar' => $this->getMockBuilder(QuoteTransfer::class)
                ->disableOriginalConstructor()
                ->getMock(),
        ];

        $this->plugin = new OrderCustomReferencesRestSplittableCheckoutExpanderPlugin();
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $orderCustomReferences = [
            'foo' => 'bar',
            'bar' => null,
        ];

        $this->splittableCheckoutTransferMock->expects(static::atLeastOnce())
            ->method('getSplittedQuotes')
            ->willReturn($this->quoteTransferMocks);

        foreach ($this->quoteTransferMocks as $key => $quoteTransferMock) {
            $quoteTransferMock->expects(static::atLeastOnce())
                ->method('getSplitKey')
                ->willReturn($key);

            $quoteTransferMock->expects(static::atLeastOnce())
                ->method('getOrderCustomReference')
                ->willReturn($orderCustomReferences[$key]);
        }

        unset($orderCustomReferences['bar']);

        $this->restSplittableCheckoutTransferMock->expects(static::atLeastOnce())
            ->method('setOrderCustomReferences')
            ->with($orderCustomReferences)
            ->willReturn($this->restSplittableCheckoutTransferMock);

        static::assertEquals(
            $this->restSplittableCheckoutTransferMock,
            $this->plugin->expand($this->splittableCheckoutTransferMock, $this->restSplittableCheckoutTransferMock),
        );
    }

    /**
     * @return void
     */
    public function testExpandWithoutOrderCustomReferences(): void
    {
        $orderCustomReferences = [
            'foo' => null,
            'bar' => null,
        ];

        $this->splittableCheckoutTransferMock->expects(static::atLeastOnce())
            ->method('getSplittedQuotes')
            ->willReturn($this->quoteTransferMocks);

        foreach ($this->quoteTransferMocks as $key => $quoteTransferMock) {
            $quoteTransferMock->expects(static::atLeastOnce())
                ->method('getSplitKey')
                ->willReturn($key);

            $quoteTransferMock->expects(static::atLeastOnce())
                ->method('getOrderCustomReference')
                ->willReturn($orderCustomReferences[$key]);
        }

        $this->restSplittableCheckoutTransferMock->expects(static::never())
            ->method('setOrderCustomReferences');

        static::assertEquals(
            $this->restSplittableCheckoutTransferMock,
            $this->plugin->expand($this->splittableCheckoutTransferMock, $this->restSplittableCheckoutTransferMock),
        );
    }
}
