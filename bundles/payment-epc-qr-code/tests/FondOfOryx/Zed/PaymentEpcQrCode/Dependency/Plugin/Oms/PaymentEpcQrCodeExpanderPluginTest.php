<?php

namespace FondOfOryx\Service\PaymentEpcQrCode\Dependency\Plugin\Oms;

use Codeception\Test\Unit;
use FondOfOryx\Zed\PaymentEpcQrCode\Business\PaymentEpcQrCodeFacade;
use FondOfOryx\Zed\PaymentEpcQrCode\Dependency\Plugin\Oms\PaymentEpcQrCodeExpanderPlugin;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class PaymentEpcQrCodeExpanderPluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\MailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $mailTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfOryx\Zed\PaymentEpcQrCode\Business\PaymentEpcQrCodeFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Spryker\Zed\OmsExtension\Dependency\Plugin\OmsOrderMailExpanderPluginInterface
     */
    protected $plugin;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->mailTransferMock = $this->getMockBuilder(MailTransfer::class)->disableOriginalConstructor()->getMock();
        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)->disableOriginalConstructor()->getMock();
        $this->facadeMock = $this->getMockBuilder(PaymentEpcQrCodeFacade::class)->disableOriginalConstructor()->getMock();

        $this->plugin = new class ($this->facadeMock) extends PaymentEpcQrCodeExpanderPlugin
        {
            /**
             * @var \FondOfOryx\Zed\PaymentEpcQrCode\Business\PaymentEpcQrCodeFacade
             */
            protected $ownFacade;

            /**
             *  constructor.
             *
             * @param \FondOfOryx\Zed\PaymentEpcQrCode\Business\PaymentEpcQrCodeFacade $facade
             */
            public function __construct(PaymentEpcQrCodeFacade $facade)
            {
                $this->ownFacade = $facade;
            }

            /**
             * @return \FondOfOryx\Zed\PaymentEpcQrCode\Business\PaymentEpcQrCodeFacade
             */
            protected function getFacade(): PaymentEpcQrCodeFacade
            {
                return $this->ownFacade;
            }
        };
    }

    /**
     * @return void
     */
    public function testExpandOnPrepayment(): void
    {
        $this->plugin->expand($this->mailTransferMock, $this->orderTransferMock);
    }
}
