<?php

namespace FondOfOryx\Zed\ApiAuth\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ApiAuth\ApiAuthConfig;
use FondOfOryx\Zed\ApiAuth\Business\Model\BasicAuth;
use FondOfOryx\Zed\ApiAuth\Business\Model\BasicToken;

class ApiAuthBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ApiAuth\Business\ApiAuthBusinessFactory
     */
    protected $apiAuthBusinessFactory;

    /**
     * @var \FondOfOryx\Zed\ApiAuth\ApiAuthConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiAuthConfigMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiAuthBusinessFactory = new ApiAuthBusinessFactory();

        $this->apiAuthConfigMock = $this->getMockBuilder(ApiAuthConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiAuthBusinessFactory->setConfig($this->apiAuthConfigMock);
    }

    /**
     * @return void
     */
    public function testCreateAuthModel(): void
    {
        $this->apiAuthConfigMock->expects($this->atLeastOnce())
            ->method('getRawToken')
            ->willReturn('VDNTVDp0MyR0');

        $authModel = $this->apiAuthBusinessFactory->createAuthModel();

        $this->assertInstanceOf(BasicAuth::class, $authModel);
    }

    /**
     * @return void
     */
    public function testCreateTokenModel(): void
    {
        $this->apiAuthConfigMock->expects($this->atLeastOnce())
            ->method('getRawToken')
            ->willReturn('VDNTVDp0MyR0');

        $tokenModel = $this->apiAuthBusinessFactory->createTokenModel();

        $this->assertInstanceOf(BasicToken::class, $tokenModel);
    }
}
