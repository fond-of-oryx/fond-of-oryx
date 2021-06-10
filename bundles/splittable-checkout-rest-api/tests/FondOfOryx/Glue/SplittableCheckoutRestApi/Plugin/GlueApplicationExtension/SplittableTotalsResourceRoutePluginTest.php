<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\SplittableCheckoutRestApi\SplittableCheckoutRestApiConfig;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class SplittableTotalsResourceRoutePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Plugin\GlueApplicationExtension\SplittableTotalsResourceRoutePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceRouteCollectionMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new SplittableTotalsResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionMock->expects(static::atLeastOnce())
            ->method('addPost')
            ->with('post', false)
            ->willReturn($this->resourceRouteCollectionMock);

        static::assertEquals(
            $this->resourceRouteCollectionMock,
            $this->plugin->configure($this->resourceRouteCollectionMock)
        );
    }

    /**
     * @return void
     */
    public function testGetResourceTyp(): void
    {
        static::assertEquals(
            SplittableCheckoutRestApiConfig::RESOURCE_SPLITTABLE_TOTALS,
            $this->plugin->getResourceType()
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        static::assertEquals(
            SplittableCheckoutRestApiConfig::CONTROLLER_SPLITTABLE_TOTALS,
            $this->plugin->getController()
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        static::assertEquals(
            RestSplittableCheckoutRequestAttributesTransfer::class,
            $this->plugin->getResourceAttributesClassName()
        );
    }
}
