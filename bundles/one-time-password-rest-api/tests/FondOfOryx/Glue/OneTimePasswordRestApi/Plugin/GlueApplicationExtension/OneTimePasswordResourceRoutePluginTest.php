<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class OneTimePasswordResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\OneTimePasswordRestApi\Plugin\GlueApplicationExtension\OneTimePasswordResourceRoutePlugin
     */
    protected $oneTimePasswordResourceRoutePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->resourceRouteCollectionMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordResourceRoutePlugin = new OneTimePasswordResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionMock->expects($this->atLeastOnce())
            ->method('addPost')
            ->with('post', false)
            ->willReturnSelf();

        $this->assertSame(
            $this->resourceRouteCollectionMock,
            $this->oneTimePasswordResourceRoutePlugin->configure(
                $this->resourceRouteCollectionMock
            )
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertIsString(
            $this->oneTimePasswordResourceRoutePlugin->getResourceType()
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertIsString(
            $this->oneTimePasswordResourceRoutePlugin->getController()
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertIsString(
            $this->oneTimePasswordResourceRoutePlugin->getResourceAttributesClassName()
        );
    }
}
