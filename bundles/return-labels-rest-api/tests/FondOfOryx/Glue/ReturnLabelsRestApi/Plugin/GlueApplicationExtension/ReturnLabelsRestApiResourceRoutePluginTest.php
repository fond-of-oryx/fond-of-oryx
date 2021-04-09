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
     * @var \FondOfOryx\Glue\ReturnLabelsRestApi\Plugin\GlueApplicationExtension\ReturnLabelsRestApiResourceRoutePlugin
     */
    protected $plugin;

    /**
     * @var \Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $resourceRouteCollectionMock;

    /**
     * @return void
     */
    protected function _before(): void
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
        $this->resourceRouteCollectionMock->expects($this->once())
            ->method('addPost')
            ->willReturn($this->resourceRouteCollectionMock);

        $collection = $this->plugin->configure($this->resourceRouteCollectionMock);

        $this->assertInstanceOf(ResourceRouteCollectionInterface::class, $collection);
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertSame(ReturnLabelsRestApiConfig::RESOURCE_RETURN_LABELS_REST_API, $this->plugin->getResourceType());
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame(ReturnLabelsRestApiConfig::CONTROLLER_RETURN_LABELS_REST_API, $this->plugin->getController());
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(RestReturnLabelRequestAttributesTransfer::class, $this->plugin->getResourceAttributesClassName());
    }
}
