<?php

namespace FondOfOryx\Yves\Prepayment\Dependency\Injector;

use Codeception\Test\Unit;
use Spryker\Yves\Kernel\Container;

class CheckoutPageDependencyInjectorTest extends Unit
{
    /**
     * @var \Spryker\Yves\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Yves\Prepayment\Dependency\Injector\CheckoutDependencyInjector
     */
    protected $injector;

    /**
     * @return void
     */
    public function _before()
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(Container::class)->disableOriginalConstructor()->getMock();

        $this->injector = new CheckoutPageDependencyInjector();
    }
}
