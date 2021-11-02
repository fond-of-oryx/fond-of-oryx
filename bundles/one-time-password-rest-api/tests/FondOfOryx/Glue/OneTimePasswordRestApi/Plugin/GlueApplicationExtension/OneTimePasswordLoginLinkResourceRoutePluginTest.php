<?php

namespace FondOfOryx\Glue\OneTimePasswordRestApi\Plugin\GlueApplicationExtension;

use Codeception\Test\Unit;
use FondOfOryx\Glue\OneTimePasswordRestApi\OneTimePasswordRestApiConfig;
use Generated\Shared\Transfer\RestOneTimePasswordLoginLinkRequestAttributesTransfer;
use Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface;

class OneTimePasswordLoginLinkResourceRoutePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\OneTimePasswordRestApi\Plugin\GlueApplicationExtension\OneTimePasswordLoginLinkResourceRoutePlugin
     */
    protected $oneTimePasswordLoginLinkResourceRoutePlugin;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplicationExtension\Dependency\Plugin\ResourceRouteCollectionInterface|mixed
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

        $this->oneTimePasswordLoginLinkResourceRoutePlugin = new OneTimePasswordLoginLinkResourceRoutePlugin();
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
            $this->oneTimePasswordLoginLinkResourceRoutePlugin->configure(
                $this->resourceRouteCollectionMock,
            ),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceType(): void
    {
        $this->assertSame(
            OneTimePasswordRestApiConfig::RESOURCE_ONE_TIME_PASSWORD_LOGIN_LINKS,
            $this->oneTimePasswordLoginLinkResourceRoutePlugin->getResourceType(),
        );
    }

    /**
     * @return void
     */
    public function testGetController(): void
    {
        $this->assertSame(
            OneTimePasswordRestApiConfig::CONTROLLER_ONE_TIME_PASSWORD_LOGIN_LINK,
            $this->oneTimePasswordLoginLinkResourceRoutePlugin->getController(),
        );
    }

    /**
     * @return void
     */
    public function testGetResourceAttributesClassName(): void
    {
        $this->assertSame(
            RestOneTimePasswordLoginLinkRequestAttributesTransfer::class,
            $this->oneTimePasswordLoginLinkResourceRoutePlugin->getResourceAttributesClassName(),
        );
    }
}
