<?php

namespace FondOfOryx\Zed\SplittableCheckout\Dependency\Facade;

use Codeception\Test\Unit;
use Spryker\Zed\Permission\Business\PermissionFacadeInterface;

class SplittableCheckoutToPermissionFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Permission\Business\PermissionFacadeInterface
     */
    protected $permissionFacadeMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPermissionFacadeBridge
     */
    protected $permissionFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->permissionFacadeMock = $this->getMockBuilder(PermissionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionFacadeBridge = new SplittableCheckoutToPermissionFacadeBridge(
            $this->permissionFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testCan(): void
    {
        $key = 'foo';
        $identifier = 1;

        $this->permissionFacadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with($key, $identifier, null)
            ->willReturn(true);

        static::assertTrue($this->permissionFacadeBridge->can($key, $identifier));
    }
}
