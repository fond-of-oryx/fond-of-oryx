<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig;
use Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class OrderBudgetSearchResourceRoutePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected ResourceRouteCollectionInterface|MockObject $resourceRouteCollectionMock;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Plugin\GlueApplicationExtension\OrderBudgetSearchResourceRoutePlugin
     */
    protected OrderBudgetSearchResourceRoutePlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->resourceRouteCollectionMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new OrderBudgetSearchResourceRoutePlugin();
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
            OrderBudgetSearchRestApiConfig::RESOURCE_ORDER_BUDGET_SEARCH,
            $this->plugin->getResourceType(),
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        static::assertEquals(
            OrderBudgetSearchRestApiConfig::CONTROLLER_RESOURCE_ORDER_BUDGET_SEARCH,
            $this->plugin->getController(),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        static::assertEquals(
            RestOrderBudgetSearchAttributesTransfer::class,
            $this->plugin->getResourceAttributesClassName(),
        );
    }
}
