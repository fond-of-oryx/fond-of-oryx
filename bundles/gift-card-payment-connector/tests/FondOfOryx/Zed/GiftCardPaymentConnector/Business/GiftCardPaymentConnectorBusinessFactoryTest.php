<?php

namespace FondOfOryx\Zed\GiftCardPaymentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\GiftCardPaymentConnector\Business\PaymentMethodFilter\GiftCardPaymentConnectorPaymentMethodFilter;
use FondOfOryx\Zed\GiftCardPaymentConnector\GiftCardPaymentConnectorConfig;

class GiftCardPaymentConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\GiftCardPaymentConnector\GiftCardPaymentConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\GiftCardPaymentConnector\Business\GiftCardPaymentConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @var \FondOfOryx\Zed\GiftCardPaymentConnector\Business\PaymentMethodFilter\GiftCardPaymentConnectorPaymentMethodFilter|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $GiftCardPaymentConnectorPaymentMethodFilterMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(GiftCardPaymentConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->GiftCardPaymentConnectorPaymentMethodFilterMock = $this->getMockBuilder(GiftCardPaymentConnectorPaymentMethodFilter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new GiftCardPaymentConnectorBusinessFactory();
        $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateGiftCardPaymentConnectorPaymentMethod(): void
    {
        $this->factory->createGiftCardPaymentConnectorPaymentMethod();
    }
}
