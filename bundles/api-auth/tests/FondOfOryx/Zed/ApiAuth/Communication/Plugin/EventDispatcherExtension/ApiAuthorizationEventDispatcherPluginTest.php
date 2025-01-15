<?php

namespace FondOfOryx\Zed\ApiAuth\Communication\Plugin\EventDispatcherExtension;

use Closure;
use Codeception\Test\Unit;
use Exception;
use FondOfOryx\Shared\ApiAuth\ApiAuthConstants;
use FondOfOryx\Zed\ApiAuth\Business\ApiAuthFacade;
use ReflectionMethod;
use Spryker\Service\Container\ContainerInterface;
use Spryker\Shared\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ApiAuthorizationEventDispatcherPluginTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Service\Container\ContainerInterface
     */
    protected $containerMock;

    /**
     * @var \Spryker\Shared\EventDispatcher\EventDispatcherInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $eventDispatcherMock;

    /**
     * @var \FondOfOryx\Zed\ApiAuth\Business\ApiAuthFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $apiAuthFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpKernel\Event\RequestEvent
     */
    protected $requestEventMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request
     */
    protected $requestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $attributesMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\HeaderBag
     */
    protected $headersMock;

    /**
     * @var \FondOfOryx\Zed\ApiAuth\Communication\Plugin\EventDispatcherExtension\ApiAuthorizationEventDispatcherPlugin
     */
    protected $apiAuthorizationEventDispatcherPlugin;

    /**
     * @var \ReflectionMethod
     */
    protected $onKernelRequestMethod;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->containerMock = $this->getMockBuilder(ContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->eventDispatcherMock = $this->getMockBuilder(EventDispatcherInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiAuthFacadeMock = $this->getMockBuilder(ApiAuthFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestEventMock = $this->getMockBuilder(RequestEvent::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->attributesMock = $this->getMockBuilder(ParameterBag::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->headersMock = $this->getMockBuilder(HeaderBag::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock->attributes = $this->attributesMock;
        $this->requestMock->headers = $this->headersMock;

        $this->apiAuthorizationEventDispatcherPlugin = new ApiAuthorizationEventDispatcherPlugin();
        $this->apiAuthorizationEventDispatcherPlugin->setFacade($this->apiAuthFacadeMock);

        $this->onKernelRequestMethod = new ReflectionMethod(
            $this->apiAuthorizationEventDispatcherPlugin,
            'onKernelRequest',
        );
        $this->onKernelRequestMethod->setAccessible(true);
    }

    /**
     * @return void
     */
    public function testExtend(): void
    {
        $this->eventDispatcherMock->expects(self::atLeastOnce())
            ->method('addListener')
            ->with(KernelEvents::REQUEST, self::isInstanceOf(Closure::class));

        self::assertEquals(
            $this->eventDispatcherMock,
            $this->apiAuthorizationEventDispatcherPlugin->extend($this->eventDispatcherMock, $this->containerMock),
        );
    }

    /**
     * @return void
     */
    public function testOnKernelRequest(): void
    {
        $self = $this;

        $token = 'foo';

        $this->requestEventMock->expects(self::atLeastOnce())
            ->method('getRequest')
            ->willReturn($this->requestMock);

        $callCount = $this->atLeastOnce();
        $this->attributesMock->expects($callCount)
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self, $callCount) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame('module', $key);

                        return 'api';
                    case 2:
                        $self->assertSame('controller', $key);

                        return 'rest';
                }

                throw new Exception('Unexpected call count');
            });

        $this->headersMock->expects(self::atLeastOnce())
            ->method('get')
            ->with(ApiAuthConstants::HEADER_AUTHORIZATION, '')
            ->willReturn($token);

        $this->apiAuthFacadeMock->expects(self::atLeastOnce())
            ->method('isAuthenticated')
            ->with($token)
            ->willReturn(true);

        $this->requestEventMock->expects(self::never())
            ->method('setResponse')
            ->with(self::isInstanceOf(Response::class))
            ->willReturn($this->requestMock);

        $this->onKernelRequestMethod->invokeArgs(
            $this->apiAuthorizationEventDispatcherPlugin,
            [$this->requestEventMock],
        );
    }

    /**
     * @return void
     */
    public function testOnKernelRequestWithInvalidToken(): void
    {
        $self = $this;

        $token = 'foo';

        $this->requestEventMock->expects(self::atLeastOnce())
            ->method('getRequest')
            ->willReturn($this->requestMock);

        $callCount = $this->atLeastOnce();
        $this->attributesMock->expects($callCount)
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self, $callCount) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame('module', $key);

                        return 'api';
                    case 2:
                        $self->assertSame('controller', $key);

                        return 'rest';
                }

                throw new Exception('Unexpected call count');
            });

        $this->headersMock->expects(self::atLeastOnce())
            ->method('get')
            ->with(ApiAuthConstants::HEADER_AUTHORIZATION, '')
            ->willReturn($token);

        $this->apiAuthFacadeMock->expects(self::atLeastOnce())
            ->method('isAuthenticated')
            ->with($token)
            ->willReturn(false);

        $this->requestEventMock->expects(self::atLeastOnce())
            ->method('setResponse')
            ->with(self::isInstanceOf(Response::class))
            ->willReturn($this->requestMock);

        $this->onKernelRequestMethod->invokeArgs(
            $this->apiAuthorizationEventDispatcherPlugin,
            [$this->requestEventMock],
        );
    }

    /**
     * @return void
     */
    public function testOnKernelRequestWithInvalidModule(): void
    {
        $self = $this;

        $token = 'foo';

        $this->requestEventMock->expects(self::atLeastOnce())
            ->method('getRequest')
            ->willReturn($this->requestMock);

        $callCount = $this->atLeastOnce();
        $this->attributesMock->expects($callCount)
            ->method('get')
            ->willReturnCallback(static function (string $key) use ($self, $callCount) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame('module', $key);

                        return 'foo';
                    case 2:
                        $self->assertSame('controller', $key);

                        return 'rest';
                }

                throw new Exception('Unexpected call count');
            });

        $this->headersMock->expects(self::never())
            ->method('get')
            ->with(ApiAuthConstants::HEADER_AUTHORIZATION, '')
            ->willReturn($token);

        $this->apiAuthFacadeMock->expects(self::never())
            ->method('isAuthenticated')
            ->with($token)
            ->willReturn(true);

        $this->requestEventMock->expects(self::never())
            ->method('setResponse')
            ->with(self::isInstanceOf(Response::class))
            ->willReturn($this->requestMock);

        $this->onKernelRequestMethod->invokeArgs(
            $this->apiAuthorizationEventDispatcherPlugin,
            [$this->requestEventMock],
        );
    }
}
