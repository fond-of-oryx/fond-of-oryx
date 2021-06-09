<?php

namespace FondOfOryx\Zed\Prepayment\Dependency\Injector;

use Codeception\Test\Unit;
use Spryker\Zed\Kernel\Container;
use Spryker\Zed\Payment\PaymentDependencyProvider;

class PaymentDependencyInjectorTest extends Unit
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

        $this->injector = new PaymentDependencyInjector();
    }

    /**
     * @return void
     */
    public function testInjectPaymentPlugins(): void
    {
        $this->containerMock->expects(static::once())->method('extend')->willReturn(static function ($string, $callback) {
            static::assertSame(PaymentDependencyProvider::CHECKOUT_PLUGINS, $string);

            return $callback;
        });
        $this->injector->injectBusinessLayerDependencies($this->containerMock);
    }
}
