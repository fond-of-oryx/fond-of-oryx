<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\Locale\LocaleClientInterface;

class ProductLocaleRestrictionStorageToLocaleClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Locale\LocaleClientInterface
     */
    protected $localeClientMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Dependency\Client\ProductLocaleRestrictionStorageToLocaleClientBridge
     */
    protected $productLocaleRestrictionStorageToLocaleClientBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->localeClientMock = $this->getMockBuilder(LocaleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionStorageToLocaleClientBridge = new ProductLocaleRestrictionStorageToLocaleClientBridge(
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
            $this->productLocaleRestrictionStorageToLocaleClientBridge->getCurrentLocale()
        );
    }
}
