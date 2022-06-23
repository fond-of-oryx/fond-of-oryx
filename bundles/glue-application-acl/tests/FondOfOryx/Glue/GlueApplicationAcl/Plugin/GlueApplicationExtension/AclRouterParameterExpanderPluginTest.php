<?php

namespace FondOfOryx\Glue\GlueApplicationAcl\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\GlueApplicationAcl\GlueApplicationAclConfig;
use Spryker\Glue\GlueApplication\Rest\Collection\ResourceRouteCollection;
use Spryker\Glue\GlueApplication\Rest\RequestConstantsInterface;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface;

class AclRouterParameterExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\GlueApplicationAcl\GlueApplicationAclConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRoutePluginInterface
     */
    protected $resourceRoutePluginMock;

    /**
     * @var \FondOfOryx\Glue\GlueApplicationAcl\Plugin\GlueApplicationExtension\AclRouterParameterExpanderPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->configMock = $this->getMockBuilder(GlueApplicationAclConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->resourceRoutePluginMock = $this->getMockBuilder(ResourceRoutePluginInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new AclRouterParameterExpanderPlugin();
        $this->plugin->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testExpandResourceConfiguration(): void
    {
        $unprotectedResourceTypes = [
            'foo' => ['get_action'],
        ];

        $resourceConfiguration = [
            RequestConstantsInterface::ATTRIBUTE_TYPE => 'foo',
            RequestConstantsInterface::ATTRIBUTE_CONFIGURATION => [
                ResourceRouteCollection::CONTROLLER_ACTION => 'get_action',
                ResourceRouteCollection::IS_PROTECTED => true,
            ],
        ];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getUnprotectedResourceTypes')
            ->willReturn($unprotectedResourceTypes);

        $resourceConfiguration = $this->plugin->expandResourceConfiguration(
            $this->resourceRoutePluginMock,
            $resourceConfiguration,
        );

        static::assertFalse(
            $resourceConfiguration[RequestConstantsInterface::ATTRIBUTE_CONFIGURATION][ResourceRouteCollection::IS_PROTECTED],
        );
    }

    /**
     * @return void
     */
    public function testExpandResourceConfigurationWithInvalidConfig(): void
    {
        $unprotectedResourceTypes = [
            'foo',
        ];

        $resourceConfiguration = [
            RequestConstantsInterface::ATTRIBUTE_TYPE => 'foo',
            RequestConstantsInterface::ATTRIBUTE_CONFIGURATION => [
                ResourceRouteCollection::CONTROLLER_ACTION => 'get_action',
                ResourceRouteCollection::IS_PROTECTED => true,
            ],
        ];

        $this->configMock->expects(static::atLeastOnce())
            ->method('getUnprotectedResourceTypes')
            ->willReturn($unprotectedResourceTypes);

        $resourceConfiguration = $this->plugin->expandResourceConfiguration(
            $this->resourceRoutePluginMock,
            $resourceConfiguration,
        );

        static::assertTrue(
            $resourceConfiguration[RequestConstantsInterface::ATTRIBUTE_CONFIGURATION][ResourceRouteCollection::IS_PROTECTED],
        );
    }

    /**
     * @return void
     */
    public function testExpandRouteParameters(): void
    {
        $resourceConfiguration = [
            RequestConstantsInterface::ATTRIBUTE_TYPE => 'foo',
            RequestConstantsInterface::ATTRIBUTE_CONFIGURATION => [
                ResourceRouteCollection::CONTROLLER_ACTION => 'get_action',
                ResourceRouteCollection::IS_PROTECTED => true,
            ],
        ];

        $routeParams = [];

        static::assertEquals($routeParams, $this->plugin->expandRouteParameters($resourceConfiguration, $routeParams));
    }
}
