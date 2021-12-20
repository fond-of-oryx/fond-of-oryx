<?php

namespace FondOfOryx\Zed\ApiAuth;

use Codeception\Test\Unit;
use FondOfOryx\Shared\ApiAuth\ApiAuthConstants;

class ApiAuthConfigTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ApiAuth\ApiAuthConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiAuthConfig;

    /**
     * @return void
     */
    protected function _before()
    {
        $this->apiAuthConfig = $this->getMockBuilder(ApiAuthConfig::class)
            ->setMethods(['get'])
            ->getMock();
    }

    /**
     * @return void
     */
    public function testGetDefaultRawToken()
    {
        $rawToken = '';

        $this->apiAuthConfig->expects($this->atLeastOnce())
            ->method('get')
            ->with(ApiAuthConstants::RAW_TOKEN, '')
            ->willReturn($rawToken);

        $this->assertEquals($rawToken, $this->apiAuthConfig->getRawToken());
    }

    /**
     * @return void
     */
    public function testGetCustomRawToken()
    {
        $rawToken = 'cmF3X3Rva2VuOnJhd190b2tlbg==';

        $this->apiAuthConfig->expects($this->atLeastOnce())
            ->method('get')
            ->with(ApiAuthConstants::RAW_TOKEN, '')
            ->willReturn($rawToken);

        $this->assertEquals($rawToken, $this->apiAuthConfig->getRawToken());
    }
}
