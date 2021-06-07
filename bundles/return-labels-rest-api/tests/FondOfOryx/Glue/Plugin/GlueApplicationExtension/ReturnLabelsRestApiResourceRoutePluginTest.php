<?php

namespace FondOfOryx\Glue\ReturnLabelsRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ReturnLabelsRestApi\ReturnLabelsRestApiConfig;
use Generated\Shared\Transfer\RestReturnLabelRequestAttributesTransfer;
use Spryker\Glue\GlueApplication\Rest\Collection\ResourceRouteCollection;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class ReturnLabelsRestApiResourceRoutePluginTest extends Unit
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

        $this->plugin = new ReturnLabelsRestApiResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionMock->expects(static::once())
            ->method('addPost')
            ->willReturn($this->resourceRouteCollectionMock);

        $collection = $this->plugin->configure($this->resourceRouteCollectionMock);

        static::assertInstanceOf(ResourceRouteCollectionInterface::class, $collection);
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        static::assertSame(ReturnLabelsRestApiConfig::RESOURCE_RETURN_LABELS, $this->plugin->getResourceType());
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        static::assertSame(ReturnLabelsRestApiConfig::CONTROLLER_RETURN_LABELS, $this->plugin->getController());
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        static::assertSame(RestReturnLabelRequestAttributesTransfer::class, $this->plugin->getResourceAttributesClassName());
    }
}
