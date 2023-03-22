<?php

namespace FondOfOryx\Glue\CustomerRegistrationRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class CustomerRegistrationResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CustomerRegistrationRestApi\Plugin\GlueApplicationExtension\CustomerRegistrationResourceRoutePlugin
     */
    protected $customerRegistrationResourceRoutePlugin;

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

        $this->customerRegistrationResourceRoutePlugin = new CustomerRegistrationResourceRoutePlugin();
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
            $this->customerRegistrationResourceRoutePlugin->configure(
                $this->resourceRouteCollectionMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertIsString(
            $this->customerRegistrationResourceRoutePlugin->getResourceType(),
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertIsString(
            $this->customerRegistrationResourceRoutePlugin->getController(),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertIsString(
            $this->customerRegistrationResourceRoutePlugin->getResourceAttributesClassName(),
        );
    }
}
