<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig;
use Generated\Shared\Transfer\RestCompanySearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class CompanySearchResourceRoutePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Plugin\GlueApplicationExtension\CompanySearchResourceRoutePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->resourceRouteCollectionMock = $this->getMockBuilder(ResourceRouteCollectionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanySearchResourceRoutePlugin();
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
            CompanySearchRestApiConfig::RESOURCE_COMPANY_SEARCH,
            $this->plugin->getResourceType(),
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        static::assertEquals(
            CompanySearchRestApiConfig::CONTROLLER_RESOURCE_COMPANY_SEARCH,
            $this->plugin->getController(),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        static::assertEquals(
            RestCompanySearchAttributesTransfer::class,
            $this->plugin->getResourceAttributesClassName(),
        );
    }
}
