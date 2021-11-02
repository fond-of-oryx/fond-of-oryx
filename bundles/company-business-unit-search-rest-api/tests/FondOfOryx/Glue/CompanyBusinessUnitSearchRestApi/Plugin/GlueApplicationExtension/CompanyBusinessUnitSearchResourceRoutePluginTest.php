<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiConfig;
use Generated\Shared\Transfer\RestCompanyBusinessUnitSearchAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class CompanyBusinessUnitSearchResourceRoutePluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface
     */
    protected $resourceRouteCollectionMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Plugin\GlueApplicationExtension\CompanyBusinessUnitSearchResourceRoutePlugin
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

        $this->plugin = new CompanyBusinessUnitSearchResourceRoutePlugin();
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
            CompanyBusinessUnitSearchRestApiConfig::RESOURCE_COMPANY_BUSINESS_UNIT_SEARCH,
            $this->plugin->getResourceType(),
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        static::assertEquals(
            CompanyBusinessUnitSearchRestApiConfig::CONTROLLER_RESOURCE_COMPANY_BUSINESS_UNIT_SEARCH,
            $this->plugin->getController(),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        static::assertEquals(
            RestCompanyBusinessUnitSearchAttributesTransfer::class,
            $this->plugin->getResourceAttributesClassName(),
        );
    }
}
