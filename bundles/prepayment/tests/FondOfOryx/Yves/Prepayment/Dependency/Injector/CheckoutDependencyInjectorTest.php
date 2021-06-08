<?php

namespace FondOfOryx\Yves\Prepayment\Dependency\Injector;

use Codeception\Test\Unit;
use Spryker\Yves\Checkout\CheckoutDependencyProvider;
use Spryker\Yves\Kernel\Container;

class CheckoutDependencyInjectorTest extends Unit
{
    /**
     * @var \Spryker\Yves\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \Spryker\Yves\Kernel\Dependency\Injector\DependencyInjectorInterface
     */
    protected $injector;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)->disableOriginalConstructor()->getMock();
        $this->injector = new CheckoutDependencyInjector();
    }

    /**
     * @return void
     */
    public function testInject(): void
    {
        $this->containerMock->expects(static::exactly(2))->method('extend')->willReturn(static function ($string, $callback) {
            if ($string === CheckoutDependencyProvider::PAYMENT_SUB_FORMS) {
                static::assertSame(CheckoutDependencyProvider::PAYMENT_SUB_FORMS, $string);

                return $callback;
            }

            static::assertSame(CheckoutDependencyProvider::PAYMENT_METHOD_HANDLER, $string);

            return $callback;
        });
        $this->injector->inject($this->containerMock);
    }
}
