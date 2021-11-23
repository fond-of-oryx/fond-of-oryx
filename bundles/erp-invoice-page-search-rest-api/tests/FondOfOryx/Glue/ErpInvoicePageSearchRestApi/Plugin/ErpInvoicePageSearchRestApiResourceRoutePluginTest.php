<?php

namespace FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\ErpInvoicePageSearchRestApiConfig;
use FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Plugin\GlueApplicationExtension\ErpInvoicePageSearchRestApiResourceRoutePlugin;
use Generated\Shared\Transfer\RestErpInvoicePageSearchRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\Collection\ResourceRouteCollection;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class ErpInvoicePageSearchRestApiResourceRoutePluginTest extends Unit
{
    /**
     * @var \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $resourceRouteCollectionMock;

    /**
     * @var \FondOfOryx\Glue\ErpInvoicePageSearchRestApi\Plugin\GlueApplicationExtension\ErpInvoicePageSearchRestApiResourceRoutePlugin
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

        $this->plugin = new ErpInvoicePageSearchRestApiResourceRoutePlugin();
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
        $this->assertSame(ErpInvoicePageSearchRestApiConfig::RESOURCE_ERP_INVOICE_PAGE_SEARCH_REST_API, $this->plugin->getResourceType());
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame(ErpInvoicePageSearchRestApiConfig::CONTROLLER_ERP_INVOICE_PAGE_SEARCH_REST_API, $this->plugin->getController());
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(RestErpInvoicePageSearchRequestAttributesTransfer::class, $this->plugin->getResourceAttributesClassName());
    }
}
