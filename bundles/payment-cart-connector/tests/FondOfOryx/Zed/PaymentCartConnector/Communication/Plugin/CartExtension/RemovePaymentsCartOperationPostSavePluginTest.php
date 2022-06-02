<?php

namespace FondOfOryx\Zed\PaymentCartConnector\Communication\Plugin\CartExtension;

use ArrayObject;
use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteTransfer;

class RemovePaymentsCartOperationPostSavePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\PaymentCartConnector\Communication\Plugin\CartExtension\RemovePaymentsCartOperationPostSavePlugin
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

        $this->plugin = new RemovePaymentsCartOperationPostSavePlugin();
    }

    /**
     * @return void
     */
    public function testPostSave(): void
    {
        $this->quoteTransferMock->expects(static::atLeastOnce())
            ->method('setPayments')
            ->with(
                static::callback(
                    static function (ArrayObject $paymentTransfers) {
                        return $paymentTransfers->count() === 0;
                    },
                ),
            )->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->quoteTransferMock,
            $this->plugin->postSave($this->quoteTransferMock),
        );
    }
}
