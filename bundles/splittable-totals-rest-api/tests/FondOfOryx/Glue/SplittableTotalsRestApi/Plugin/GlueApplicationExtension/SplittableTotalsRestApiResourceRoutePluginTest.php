<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\SplittableTotalsRestApi\SplittableTotalsRestApiConfig;
use Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class SplittableTotalsRestApiResourceRoutePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionMock;

    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\Plugin\GlueApplicationExtension\SplittableTotalsRestApiResourceRoutePlugin
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

        $this->plugin = new SplittableTotalsRestApiResourceRoutePlugin();
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
            SplittableTotalsRestApiConfig::RESOURCE_SPLITTABLE_TOTALS,
            $this->plugin->getResourceType()
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        static::assertEquals(
            SplittableTotalsRestApiConfig::CONTROLLER_SPLITTABLE_TOTALS,
            $this->plugin->getController()
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        static::assertEquals(
            RestSplittableTotalsRequestAttributesTransfer::class,
            $this->plugin->getResourceAttributesClassName()
        );
    }
}
