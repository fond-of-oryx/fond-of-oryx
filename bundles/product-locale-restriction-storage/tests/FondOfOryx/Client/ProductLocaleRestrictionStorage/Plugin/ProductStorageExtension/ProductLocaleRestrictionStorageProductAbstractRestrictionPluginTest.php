<?php

namespace FondOfOryx\Client\ProductLocaleRestrictionStorage\Plugin\ProductStorageExtension;

use Codeception\Test\Unit;
use FondOfOryx\Client\ProductLocaleRestrictionStorage\ProductLocaleRestrictionStorageClient;
use Spryker\Client\Kernel\AbstractClient;

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

        if (method_exists(ProductLocaleRestrictionStorageProductAbstractRestrictionPlugin::class, 'setClient')) {
            $this->plugin = new ProductLocaleRestrictionStorageProductAbstractRestrictionPlugin();
            $this->plugin->setClient($this->clientMock);
        } else {
            $this->plugin = new class ($this->clientMock) extends ProductLocaleRestrictionStorageProductAbstractRestrictionPlugin {
                /**
                 * @var \Spryker\Client\Kernel\AbstractClient
                 */
                protected $productLocaleRestrictionStorageClient;

                /**
                 * @param \Spryker\Client\Kernel\AbstractClient $client
                 */
                public function __construct(AbstractClient $client)
                {
                    $this->productLocaleRestrictionStorageClient = $client;
                }

                /**
                 * @return \Spryker\Client\Kernel\AbstractClient
                 */
                protected function getClient(): AbstractClient
                {
                    return $this->productLocaleRestrictionStorageClient;
                }
            };
        }
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
