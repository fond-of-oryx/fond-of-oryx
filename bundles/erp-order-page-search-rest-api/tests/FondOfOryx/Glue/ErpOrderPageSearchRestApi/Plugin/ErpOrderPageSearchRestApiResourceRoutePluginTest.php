<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\ErpOrderPageSearchRestApiConfig;
use FondOfOryx\Glue\ErpOrderPageSearchRestApi\Plugin\GlueApplicationExtension\ErpOrderPageSearchRestApiResourceRoutePlugin;
use Generated\Shared\Transfer\RestErpOrderPageSearchRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\Collection\ResourceRouteCollection;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class ErpOrderPageSearchRestApiResourceRoutePluginTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $resourceRouteCollectionMock;

    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\Plugin\GlueApplicationExtension\ErpOrderPageSearchRestApiResourceRoutePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->resourceRouteCollectionMock = $this
            ->getMockBuilder(ResourceRouteCollection::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ErpOrderPageSearchRestApiResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionMock->expects($this->once())->method('addGet')->willReturn($this->resourceRouteCollectionMock);

        $collection = $this->plugin->configure($this->resourceRouteCollectionMock);

        $this->assertInstanceOf(ResourceRouteCollectionInterface::class, $collection);
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertSame(ErpOrderPageSearchRestApiConfig::RESOURCE_ERP_ORDER_PAGE_SEARCH_REST_API, $this->plugin->getResourceType());
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame(ErpOrderPageSearchRestApiConfig::CONTROLLER_ERP_ORDER_PAGE_SEARCH_REST_API, $this->plugin->getController());
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(RestErpOrderPageSearchRequestAttributesTransfer::class, $this->plugin->getResourceAttributesClassName());
    }
}
