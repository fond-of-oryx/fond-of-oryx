<?php

namespace FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade;

use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Zed\Permission\Business\PermissionFacadeInterface;

class CompanyProductListSearchRestApiToPermissionFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Zed\Permission\Business\PermissionFacadeInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MockObject|PermissionFacadeInterface $facadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListSearchRestApi\Dependency\Facade\CompanyProductListSearchRestApiToPermissionFacadeBridge
     */
    protected CompanyProductListSearchRestApiToPermissionFacadeBridge $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(PermissionFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new CompanyProductListSearchRestApiToPermissionFacadeBridge(
            $this->facadeMock,
        );
    }

    /**
     * @return void
     */
    public function testCan(): void
    {
        $permissionKey = 'foo';
        $identifier = 1;

        $this->facadeMock->expects(static::atLeastOnce())
            ->method('can')
            ->with($permissionKey, $identifier, null)
            ->willReturn(true);

        static::assertTrue($this->bridge->can($permissionKey, $identifier, null));
    }
}
