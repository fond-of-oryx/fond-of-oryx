<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionCartConnector\Plugin\CartExtension;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductLocaleRestrictionCartConnector\Dependency\Client\ProductLocaleRestrictionCartConnectorToLocaleClientInterface;
use FondOfOryx\Client\ProductLocaleRestrictionCartConnector\ProductLocaleRestrictionCartConnectorFactory;
use Generated\Shared\Transfer\CartChangeTransfer;

class LocaleCartChangeRequestExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionCartConnector\ProductLocaleRestrictionCartConnectorFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productLocaleRestrictionCartConnectorFactoryMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionCartConnector\Dependency\Client\ProductLocaleRestrictionCartConnectorToLocaleClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeClientMock;

    /**
     * @var \Generated\Shared\Transfer\CartChangeTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $cartChangeTransferMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionCartConnector\Plugin\CartExtension\LocaleCartChangeRequestExpanderPlugin
     */
    protected $localeCartChangeRequestExpanderPlugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->productLocaleRestrictionCartConnectorFactoryMock = $this->getMockBuilder(ProductLocaleRestrictionCartConnectorFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeClientMock = $this->getMockBuilder(ProductLocaleRestrictionCartConnectorToLocaleClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->cartChangeTransferMock = $this->getMockBuilder(CartChangeTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeCartChangeRequestExpanderPlugin = new LocaleCartChangeRequestExpanderPlugin();
        $this->localeCartChangeRequestExpanderPlugin->setFactory(
            $this->productLocaleRestrictionCartConnectorFactoryMock,
        );
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $currentLocale = 'de_DE';

        $this->productLocaleRestrictionCartConnectorFactoryMock->expects(static::atLeastOnce())
            ->method('getLocaleClient')
            ->willReturn($this->localeClientMock);

        $this->localeClientMock->expects(static::atLeastOnce())
            ->method('getCurrentLocale')
            ->willReturn($currentLocale);

        $this->cartChangeTransferMock->expects(static::atLeastOnce())
            ->method('setCurrentLocale')
            ->with($currentLocale)
            ->willReturn($this->cartChangeTransferMock);

        static::assertEquals(
            $this->cartChangeTransferMock,
            $this->localeCartChangeRequestExpanderPlugin->expand($this->cartChangeTransferMock),
        );
    }
}
