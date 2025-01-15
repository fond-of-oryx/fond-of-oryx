<?php

namespace FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\PaymentMethodFilter\ThirtyFiveUpPaymentMethodFilter;
use FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\ThirtyFiveUpPaymentConnectorConfig;

class ThirtyFiveUpPaymentConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\ThirtyFiveUpPaymentConnectorBusinessFactory
     */
    protected $businessFactory;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\Business\PaymentMethodFilter\ThirtyFiveUpPaymentMethodFilter|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpPaymentMethodFilterMock;

    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpPaymentConnector\ThirtyFiveUpPaymentConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $thirtyFiveUpPaymentConnectorConfigMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->thirtyFiveUpPaymentMethodFilterMock = $this->getMockBuilder(ThirtyFiveUpPaymentMethodFilter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->thirtyFiveUpPaymentConnectorConfigMock = $this->getMockBuilder(ThirtyFiveUpPaymentConnectorConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->businessFactory = new ThirtyFiveUpPaymentConnectorBusinessFactory();
        $this->businessFactory->setConfig($this->thirtyFiveUpPaymentConnectorConfigMock);
    }

    /**
     * @return void
     */
    public function testCreateThirtyFiveUpPaymentMethodFilter(): void
    {
        $this->businessFactory->createThirtyFiveUpPaymentMethodFilter();
    }
}
