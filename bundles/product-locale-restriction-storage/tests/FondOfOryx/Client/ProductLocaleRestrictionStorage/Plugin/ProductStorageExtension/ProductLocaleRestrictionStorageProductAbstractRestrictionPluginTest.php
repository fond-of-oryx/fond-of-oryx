<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Plugin\ProductStorageExtension;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageClient;

class ProductLocaleRestrictionStorageProductAbstractRestrictionPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageClient|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \FondOfOryx\Client\ProductLocaleRestrictionStorage\Plugin\ProductStorageExtension\ProductLocaleRestrictionStorageProductAbstractRestrictionPlugin
     */
    protected $plugin;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->clientMock = $this->getMockBuilder(ProductLocaleRestrictionStorageClient::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ProductLocaleRestrictionStorageProductAbstractRestrictionPlugin();
        $this->plugin->setClient($this->clientMock);
    }

    /**
     * @return void
     */
    public function testIsRestricted(): void
    {
        $idProductAbstract = 1;

        $this->clientMock->expects(static::atLeastOnce())
            ->method('isProductAbstractRestricted')
            ->with($idProductAbstract)
            ->willReturn(true);

        static::assertTrue($this->plugin->isRestricted($idProductAbstract));
    }
}
