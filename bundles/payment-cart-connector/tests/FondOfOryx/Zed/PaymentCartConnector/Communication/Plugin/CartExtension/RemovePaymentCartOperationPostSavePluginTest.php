<?php

namespace FondOfOryx\Zed\PaymentCartConnector\Communication\Plugin\CartExtension;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;

class RemovePaymentCartOperationPostSavePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\PaymentCartConnector\Communication\Plugin\CartExtension\RemovePaymentCartOperationPostSavePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new RemovePaymentCartOperationPostSavePlugin();
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setPayment')
            ->with(null)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->postSave($this->quoteTransferMock),
        );
    }
}
