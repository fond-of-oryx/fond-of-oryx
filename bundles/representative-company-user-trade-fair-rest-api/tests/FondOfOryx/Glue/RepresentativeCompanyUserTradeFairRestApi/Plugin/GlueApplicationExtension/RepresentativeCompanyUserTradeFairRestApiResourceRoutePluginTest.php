<?php

namespace FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\RepresentativeCompanyUserTradeFairRestApiConfig;
use Generated\Shared\Transfer\RestRepresentativeCompanyUserTradeFairAttributesTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class RepresentativeCompanyUserTradeFairRestApiResourceRoutePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected ResourceRouteCollectionInterface|MockObject $resourceRouteCollectionMock;

    /**
     * @var \FondOfOryx\Glue\RepresentativeCompanyUserTradeFairRestApi\Plugin\GlueApplicationExtension\RepresentativeCompanyUserTradeFairRestApiResourceRoutePlugin
     */
    protected RepresentativeCompanyUserTradeFairRestApiResourceRoutePlugin $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->resourceRouteCollectionMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new RepresentativeCompanyUserTradeFairRestApiResourceRoutePlugin();
    }

    /**
     * @return void
     */
    public function testConfigure(): void
    {
        $this->resourceRouteCollectionMock->expects(static::atLeastOnce())
            ->method('addPost')
            ->with('add')
            ->willReturn($this->resourceRouteCollectionMock);

        $this->resourceRouteCollectionMock->expects(static::atLeastOnce())
            ->method('addPatch')
            ->with('patch')
            ->willReturn($this->resourceRouteCollectionMock);

        $this->resourceRouteCollectionMock->expects(static::atLeastOnce())
            ->method('addDelete')
            ->with('delete')
            ->willReturn($this->resourceRouteCollectionMock);

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
            RepresentativeCompanyUserTradeFairRestApiConfig::RESOURCE_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API,
            $this->plugin->getResourceType(),
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        static::assertEquals(
            RepresentativeCompanyUserTradeFairRestApiConfig::CONTROLLER_RESOURCE_REPRESENTATIVE_COMPANY_USER_TRADE_FAIR_REST_API,
            $this->plugin->getController(),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        static::assertEquals(
            RestRepresentativeCompanyUserTradeFairAttributesTransfer::class,
            $this->plugin->getResourceAttributesClassName(),
        );
    }
}
