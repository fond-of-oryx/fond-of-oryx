<?php

namespace FondOfOryx\Zed\Prepayment\Dependency\Injector;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Oms\OmsDependencyProvider;

class OmsDependencyInjectorTest extends Unit
{
    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \Spryker\Zed\Kernel\Dependency\Injector\AbstractDependencyInjector
     */
    protected $injector;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)->disableOriginalConstructor()->getMock();
        $this->injector = new OmsDependencyInjector();
    }

    /**
     * @return void
     */
    public function testInjectBusinessLayerDependencies(): void
    {
        $this->containerMock->expects(static::exactly(3))->method('extend')->willReturn(static function ($string, $callback) {
            if ($string === OmsDependencyProvider::COMMAND_PLUGINS) {
                static::assertSame(OmsDependencyProvider::COMMAND_PLUGINS, $string);

                return $callback;
            }

            static::assertSame(OmsDependencyProvider::CONDITION_PLUGINS, $string);

            return $callback;
        });
        $this->injector->injectBusinessLayerDependencies($this->containerMock);
    }
}
