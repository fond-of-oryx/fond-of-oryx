<?php

namespace FondOfOryx\Zed\ThirtyFiveUpApi;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class ThirtyFiveUpApiDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUpApi\ThirtyFiveUpApiDependencyProvider
     */
    protected $thirtyFiveUpApiDependencyProvider;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
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

        $this->thirtyFiveUpApiDependencyProvider = new ThirtyFiveUpApiDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->thirtyFiveUpApiDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock
            )
        );
    }

    /**
     * @return void
     */
    public function testProvidePersistenceLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->thirtyFiveUpApiDependencyProvider->providePersistenceLayerDependencies(
                $this->containerMock
            )
        );
    }
}
