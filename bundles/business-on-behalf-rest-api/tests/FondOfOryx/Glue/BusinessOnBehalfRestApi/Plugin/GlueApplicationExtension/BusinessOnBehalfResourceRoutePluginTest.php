<?php

namespace FondOfOryx\Glue\BusinessOnBehalfRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\BusinessOnBehalfRestApi\BusinessOnBehalfRestApiConfig;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestAttributesTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class BusinessOnBehalfResourceRoutePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected ResourceRouteCollectionInterface|MockObject $resourceRouteCollectionMock;

    /**
     * @var \FondOfOryx\Glue\BusinessOnBehalfRestApi\Plugin\GlueApplicationExtension\BusinessOnBehalfResourceRoutePlugin
     */
    protected BusinessOnBehalfResourceRoutePlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceRouteCollectionMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new BusinessOnBehalfResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionMock->expects(static::atLeastOnce())
            ->method('addPost')
            ->with('post')
            ->willReturn($this->resourceRouteCollectionMock);

        static::assertEquals(
            $this->resourceRouteCollectionMock,
            $this->plugin->configure($this->resourceRouteCollectionMock),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceTyp(): void
    {
        static::assertEquals(
            BusinessOnBehalfRestApiConfig::RESOURCE_BUSINESS_ON_BEHALF,
            $this->plugin->getResourceType(),
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        static::assertEquals(
            BusinessOnBehalfRestApiConfig::CONTROLLER_BUSINESS_ON_BEHALF,
            $this->plugin->getController(),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        static::assertEquals(
            RestBusinessOnBehalfRequestAttributesTransfer::class,
            $this->plugin->getResourceAttributesClassName(),
        );
    }
}
