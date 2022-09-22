<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ProductListSearchRestApi\ProductListSearchRestApiConfig;
use Generated\Shared\Transfer\RestProductListSearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class ProductListSearchResourceRoutePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionMock;

    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Plugin\GlueApplicationExtension\ProductListSearchResourceRoutePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->resourceRouteCollectionMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ProductListSearchResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionMock->expects(static::atLeastOnce())
            ->method('addGet')
            ->with('get', true)
            ->willReturnSelf();

        static::assertEquals(
            $this->resourceRouteCollectionMock,
            $this->plugin->configure(
                $this->resourceRouteCollectionMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        static::assertEquals(
            ProductListSearchRestApiConfig::RESOURCE_PRODUCT_LIST_SEARCH,
            $this->plugin->getResourceType(),
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        static::assertEquals(
            ProductListSearchRestApiConfig::CONTROLLER_RESOURCE_PRODUCT_LIST_SEARCH,
            $this->plugin->getController(),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        static::assertEquals(
            RestProductListSearchAttributesTransfer::class,
            $this->plugin->getResourceAttributesClassName(),
        );
    }
}
