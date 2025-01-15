<?php

namespace FondOfOryx\Service\Trbo\Api;

use Codeception\Test\Unit;
use FondOfOryx\Service\Trbo\TrboConfig;
use FondOfOryx\Shared\Trbo\TrboConstants;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class TrboApiConfigurationTest extends Unit
{
    /**
     * @var \Symfony\Component\HttpFoundation\Request|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestMock;

    /**
     * @var \Symfony\Component\HttpFoundation\Cookie|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestCookieMock;

    /**
     * @var \Symfony\Component\HttpFoundation\HeaderBag|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $requestHeaderMock;

    /**
     * @var \FondOfOryx\Service\Trbo\TrboConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Service\Trbo\Api\TrboApiConfiguration
     */
    protected $trboApiConfiguration;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Session\Session
     */
    protected $requestSessionMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestCookieMock = $this->getMockBuilder(ParameterBag::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestHeaderMock = $this->getMockBuilder(HeaderBag::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestSessionMock = $this->getMockBuilder(Session::class)
            ->disableOriginalConstructor()
            ->getMock();

        //@phpstan-ignore-next-line
        $this->requestMock->cookies = $this->requestCookieMock;
        $this->requestMock->headers = $this->requestHeaderMock;
        $this->requestMock->method('getSession')->willReturn($this->requestSessionMock);

        $this->configMock = $this->getMockBuilder(TrboConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->trboApiConfiguration = new TrboApiConfiguration($this->configMock);
    }

    /**
     * @return void
     */
    public function testGetConfigurationGetUserIdFromCookie(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getTrboApiTimeout')
            ->willReturn('0.3');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getTrboApiShopId')
            ->willReturn('00001');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getTrboApiClientId')
            ->willReturn('001');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getTrboApiKey')
            ->willReturn('API_KEY');

        $this->configMock->expects(static::atLeastOnce())
            ->method('isHttpErrorsEnabled')
            ->willReturn(false);

        $this->requestHeaderMock->expects(static::atLeastOnce())
            ->method('get')
            ->with('referer')
            ->willReturn('referer.url');

        $this->requestCookieMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(TrboConstants::TRBO_COOKIE_USERID)
            ->willReturn('user_id');

        $response = $this->trboApiConfiguration->getConfiguration($this->requestMock);

        static::assertArrayHasKey('headers', $response);
        static::assertArrayHasKey('timeout', $response);
        static::assertArrayHasKey('json', $response);
        static::assertArrayHasKey('http_errors', $response);
    }

    /**
     * @return void
     */
    public function testGetConfigurationCreateNewUserId(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getTrboApiTimeout')
            ->willReturn('0.3');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getTrboApiShopId')
            ->willReturn('00001');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getTrboApiClientId')
            ->willReturn('001');

        $this->configMock->expects(static::atLeastOnce())
            ->method('getTrboApiKey')
            ->willReturn('API_KEY');

        $this->configMock->expects(static::atLeastOnce())
            ->method('isHttpErrorsEnabled')
            ->willReturn(false);

        $this->requestHeaderMock->expects(static::atLeastOnce())
            ->method('get')
            ->with('referer')
            ->willReturn('referer.url');

        $this->requestCookieMock->expects(static::atLeastOnce())
            ->method('get')
            ->with(TrboConstants::TRBO_COOKIE_USERID)
            ->willReturn(null);

        $response = $this->trboApiConfiguration->getConfiguration($this->requestMock);

        static::assertArrayHasKey('headers', $response);
        static::assertArrayHasKey('timeout', $response);
        static::assertArrayHasKey('json', $response);
        static::assertArrayHasKey('http_errors', $response);
    }

    /**
     * @return void
     */
    public function testGetApiUrl(): void
    {
        $this->configMock->expects(static::atLeastOnce())
            ->method('getTrboApiUrl')
            ->willReturn('api.url');

        $reponse = $this->trboApiConfiguration->getApiUrl();

        static::assertEquals('api.url', $reponse);
    }
}
