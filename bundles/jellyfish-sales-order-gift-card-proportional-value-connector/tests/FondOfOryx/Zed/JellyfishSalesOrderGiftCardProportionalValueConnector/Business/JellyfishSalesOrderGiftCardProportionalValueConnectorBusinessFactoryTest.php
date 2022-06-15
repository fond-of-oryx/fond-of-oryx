<?php

namespace FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\Mapper\ProportionalValueMapperInterface;
use FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorConfig;

class JellyfishSalesOrderGiftCardProportionalValueConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\JellyfishSalesOrderGiftCardProportionalValueConnectorConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishSalesOrderGiftCardProportionalValueConnector\Business\JellyfishSalesOrderGiftCardProportionalValueConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock =
            $this->getMockBuilder(JellyfishSalesOrderGiftCardProportionalValueConnectorConfig::class)
                ->disableOriginalConstructor()
                ->getMock();

         $this->factory = new JellyfishSalesOrderGiftCardProportionalValueConnectorBusinessFactory();
         $this->factory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateGiftCardProportionalValueMapper(): void
    {
        $this->assertInstanceOf(ProportionalValueMapperInterface::class, $this->factory->createGiftCardProportionalValueMapper());
    }
}
