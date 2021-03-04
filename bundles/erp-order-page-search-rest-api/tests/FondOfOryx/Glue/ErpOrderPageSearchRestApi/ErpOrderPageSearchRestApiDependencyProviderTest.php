<?php

namespace FondOfOryx\Glue\ErpOrderPageSearchRestApi;

use Codeception\Test\Unit;
use Spryker\Glue\Kernel\Container;

class ErpOrderPageSearchRestApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ErpOrderPageSearchRestApi\ErpOrderPageSearchRestApiDependencyProvider
     */
    protected $ErpOrderPageSearchRestApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\Kernel\Container
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->ErpOrderPageSearchRestApiDependencyProvider = new ErpOrderPageSearchRestApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->ErpOrderPageSearchRestApiDependencyProvider->provideDependencies(
                $this->containerMock
            )
        );
    }
}
