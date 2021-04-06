<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionCartConnector\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\Locale\LocaleClientInterface;

class ProductLocaleRestrictionCartConnectorToLocaleClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Locale\LocaleClientInterface
     */
    protected $localeClientMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionCartConnector\Dependency\Client\ProductLocaleRestrictionCartConnectorToLocaleClientBridge
     */
    protected $productLocaleRestrictionCartConnectorToLocaleClientBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->localeClientMock = $this->getMockBuilder(LocaleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionCartConnectorToLocaleClientBridge = new ProductLocaleRestrictionCartConnectorToLocaleClientBridge(
            $this->localeClientMock
        );
    }

    /**
     * @return void
     */
    public function testGetCurrentLocale(): void
    {
        $currentLocale = 'de_DE';

        $this->localeClientMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($currentLocale);

        static::assertEquals(
            $currentLocale,
            $this->productLocaleRestrictionCartConnectorToLocaleClientBridge->getCurrentLocale()
        );
    }
}
