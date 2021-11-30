<?php

namespace FondOfOryx\Service\Trbo;

use Codeception\Test\Unit;
use Spryker\Service\Kernel\Container;

class TrboDependencyProviderTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Service\Trbo\TrboDependencyProvider
     */
    protected $dependencyProvider;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyProvider = new TrboDependencyProvider();
    }

    /**
     * @return void
     */
    public function testProvideServiceDependencies(): void
    {
        static::assertInstanceOf(Container::class, $this->dependencyProvider->provideServiceDependencies($this->containerMock));
    }
}
