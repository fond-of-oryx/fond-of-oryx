<?php

namespace FondOfOryx\Zed\JellyfishCrossEngage;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;

class JellyfishCrossEngageDependencyProviderTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishCrossEngage\JellyfishCrossEngageDependencyProvider
     */
    protected $jellyfishCrossEngageDependencyProvider;

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

        $this->jellyfishCrossEngageDependencyProvider = new JellyfishCrossEngageDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideBusinessLayerDependencies(): void
    {
        $this->assertInstanceOf(
            Container::class,
            $this->jellyfishCrossEngageDependencyProvider->provideBusinessLayerDependencies(
                $this->containerMock
            )
        );
    }
}
