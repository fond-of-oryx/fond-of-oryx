<?php

namespace FondOfOryx\Zed\ApiAuth\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ApiAuth\Business\Model\AuthInterface;

class ApiAuthFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ApiAuth\Business\ApiAuthFacadeInterface
     */
    protected $apiAuthFacade;

    /**
     * @var \FondOfOryx\Zed\ApiAuth\Business\ApiAuthBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiAuthBusinessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\ApiAuth\Business\Model\AuthInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $authModelMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiAuthFacade = new ApiAuthFacade();

        $this->apiAuthBusinessFactoryMock = $this->getMockBuilder(ApiAuthBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->authModelMock = $this->getMockBuilder(AuthInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiAuthFacade->setFactory($this->apiAuthBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testIsAuthenticated(): void
    {
        $this->apiAuthBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createAuthModel')
            ->willReturn($this->authModelMock);

        $this->authModelMock->expects($this->atLeastOnce())
            ->method('isAuthorized')
            ->with('Basic VDNTVDp0MyR0')
            ->willReturn(true);

        $this->assertTrue($this->apiAuthFacade->isAuthenticated('Basic VDNTVDp0MyR0'));
    }

    /**
     * @return void
     */
    public function testIsAuthenticatedWithInvalidAuthHeader(): void
    {
        $this->apiAuthBusinessFactoryMock->expects($this->atLeastOnce())
            ->method('createAuthModel')
            ->willReturn($this->authModelMock);

        $this->authModelMock->expects($this->atLeastOnce())
            ->method('isAuthorized')
            ->with('Basic VDNTVDp0MyR0')
            ->willReturn(false);

        $this->assertFalse($this->apiAuthFacade->isAuthenticated('Basic VDNTVDp0MyR0'));
    }
}
