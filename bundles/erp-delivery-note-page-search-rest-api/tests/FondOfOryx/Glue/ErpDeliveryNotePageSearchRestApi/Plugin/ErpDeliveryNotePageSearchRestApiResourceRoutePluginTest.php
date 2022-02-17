<?php

namespace FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\ErpDeliveryNotePageSearchRestApiConfig;
use FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Plugin\GlueApplicationExtension\ErpDeliveryNotePageSearchRestApiResourceRoutePlugin;
use Generated\Shared\Transfer\RestErpDeliveryNotePageSearchRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\Collection\ResourceRouteCollection;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class ErpDeliveryNotePageSearchRestApiResourceRoutePluginTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $resourceRouteCollectionMock;

    /**
     * @var \FondOfOryx\Glue\ErpDeliveryNotePageSearchRestApi\Plugin\GlueApplicationExtension\ErpDeliveryNotePageSearchRestApiResourceRoutePlugin
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

        $this->plugin = new ErpDeliveryNotePageSearchRestApiResourceRoutePlugin();
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
        $this->assertSame(ErpDeliveryNotePageSearchRestApiConfig::RESOURCE_ERP_DELIVERY_NOTE_PAGE_SEARCH_REST_API, $this->plugin->getResourceType());
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame(ErpDeliveryNotePageSearchRestApiConfig::CONTROLLER_ERP_DELIVERY_NOTE_PAGE_SEARCH_REST_API, $this->plugin->getController());
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(RestErpDeliveryNotePageSearchRequestAttributesTransfer::class, $this->plugin->getResourceAttributesClassName());
    }
}
