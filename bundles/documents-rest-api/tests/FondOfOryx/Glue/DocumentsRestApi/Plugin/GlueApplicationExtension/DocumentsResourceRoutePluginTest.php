<?php

namespace FondOfOryx\Glue\DocumentsRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\DocumentsRestApi\DocumentsRestApiConfig;
use Generated\Shared\Transfer\DocumentRestRequestTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class DocumentsResourceRoutePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected ResourceRouteCollectionInterface|MockObject $resourceRouteCollectionMock;

    /**
     * @var \FondOfOryx\Glue\DocumentsRestApi\Plugin\GlueApplicationExtension\DocumentsResourceRoutePlugin
     */
    protected DocumentsResourceRoutePlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceRouteCollectionMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new DocumentsResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionMock->expects(static::atLeastOnce())
            ->method('addGet')
            ->with('get')
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
            DocumentsRestApiConfig::RESOURCE_DOCUMENTS_API,
            $this->plugin->getResourceType(),
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        static::assertEquals(
            DocumentsRestApiConfig::CONTROLLER_RESOURCE_DOCUMENTS_API,
            $this->plugin->getController(),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        static::assertEquals(
            DocumentRestRequestTransfer::class,
            $this->plugin->getResourceAttributesClassName(),
        );
    }
}
