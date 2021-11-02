<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionSearch\Dependency\Client;

use Codeception\Test\Unit;
use Spryker\Client\Locale\LocaleClientInterface;

class ProductLocaleRestrictionSearchToLocaleClientBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Locale\LocaleClientInterface
     */
    protected $localeClientMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionSearch\Dependency\Client\ProductLocaleRestrictionSearchToLocaleClientBridge
     */
    protected $productLocaleRestrictionSearchToLocaleClientBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->localeClientMock = $this->getMockBuilder(LocaleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productLocaleRestrictionSearchToLocaleClientBridge = new ProductLocaleRestrictionSearchToLocaleClientBridge(
            $this->localeClientMock,
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
            $this->productLocaleRestrictionSearchToLocaleClientBridge->getCurrentLocale(),
        );
    }
}
