<?php

namespace FondOfOryx\Zed\ApiAuth\Business\Model;

use Codeception\Test\Unit;

class BasicAuthTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ApiAuth\Business\Model\TokenInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $tokenMock;

    /**
     * @var \FondOfOryx\Zed\ApiAuth\Business\Model\BasicAuth
     */
    protected $basicAuth;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->tokenMock = $this->getMockBuilder(TokenInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->basicAuth = new BasicAuth($this->tokenMock);
    }

    /**
     * @return void
     */
    public function testIsAuthorized(): void
    {
        $authorizationType = 'Basic';
        $authorizationToken = 'VDNTVDp0MyR0';
        $authorizationHeader = $authorizationType . ' ' . $authorizationToken;

        $this->tokenMock->expects($this->atLeastOnce())
            ->method('check')
            ->with($authorizationToken)
            ->willReturn(true);

        $this->assertTrue($this->basicAuth->isAuthorized($authorizationHeader));
    }

    /**
     * @return void
     */
    public function testIsAuthorizedWithRawToken(): void
    {
        $authorizationToken = 'VDNTVDp0MyR0';
        $authorizationHeader = $authorizationToken;

        $this->tokenMock->expects($this->atLeastOnce())
            ->method('check')
            ->with($authorizationToken)
            ->willReturn(true);

        $this->assertTrue($this->basicAuth->isAuthorized($authorizationHeader));
    }
}
