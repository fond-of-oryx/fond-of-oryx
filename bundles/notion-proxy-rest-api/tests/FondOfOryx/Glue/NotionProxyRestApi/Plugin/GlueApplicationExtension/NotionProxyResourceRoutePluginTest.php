<?php

namespace FondOfOryx\Glue\NotionProxyRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\NotionProxyRestApi\NotionProxyRestApiConfig;
use Generated\Shared\Transfer\RestNotionProxyRequestAttributesTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class NotionProxyResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\NotionProxyRestApi\Plugin\GlueApplicationExtension\NotionProxyResourceRoutePlugin
     */
    protected NotionProxyResourceRoutePlugin $plugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected MockObject|ResourceRouteCollectionInterface $resourceRouteCollectionMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceRouteCollectionMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new NotionProxyResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        static::assertInstanceOf(
            ResourceRouteCollectionInterface::class,
            $this->plugin->configure($this->resourceRouteCollectionMock),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        static::assertEquals(
            NotionProxyRestApiConfig::RESOURCE_NOTION_PROXY,
            $this->plugin->getResourceType(),
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        static::assertEquals(
            NotionProxyRestApiConfig::CONTROLLER_RESOURCE_NOTION_PROXY,
            $this->plugin->getController(),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        static::assertEquals(
            RestNotionProxyRequestAttributesTransfer::class,
            $this->plugin->getResourceAttributesClassName(),
        );
    }
}
