<?php

namespace FondOfOryx\Yves\CustomerTokenManager\Controller;

use Codeception\Test\Unit;
use FondOfOryx\Yves\CustomerTokenManager\Authenticator\CustomerAuthenticator;
use FondOfOryx\Yves\CustomerTokenManager\CustomerTokenManagerFactory;
use FondOfOryx\Yves\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientBridge;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Yves\Kernel\AbstractFactory;
use Spryker\Yves\Kernel\Application;
use Spryker\Yves\Router\Router\ChainRouter;
use Symfony\Cmf\Component\Routing\ChainRouterInterface;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class AccessTokenControllerTest extends Unit
{
    /**
     * @var \FondOfOryx\Yves\CustomerTokenManager\Controller\AccessTokenController
     */
    protected $accessTokenController;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Yves\CustomerTokenManager\CustomerTokenManagerFactory
     */
    protected $customerTokenManagerFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Yves\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientBridge
     */
    protected $customerClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerResponseTransfer
     */
    protected $customerResponseTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CustomerTransfer
     */
    protected $customerTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Yves\CustomerTokenManager\Authenticator\CustomerAuthenticator
     */
    protected $customerAuthenticatorMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage
     */
    protected $tokenStorageMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken
     */
    protected $usernamePasswordTokenMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Yves\Kernel\Application
     */
    protected $applicationMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Yves\Router\Router\ChainRouter
     */
    protected $chainRouterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\Request
     */
    protected $requestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\ParameterBag
     */
    protected $parameterBagMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected $redirectResponseMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->applicationMock = $this->getMockBuilder(Application::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->redirectResponseMock = $this->getMockBuilder(RedirectResponse::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->chainRouterMock = $this->getMockBuilder(ChainRouter::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->chainRouterMock->method('generate')
            ->willReturn('something');

        $this->customerTokenManagerFactoryMock = $this->getMockBuilder(CustomerTokenManagerFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerClientMock = $this->getMockBuilder(CustomerTokenManagerToCustomerClientBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerResponseTransferMock = $this->getMockBuilder(CustomerResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerAuthenticatorMock = $this->getMockBuilder(CustomerAuthenticator::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->tokenStorageMock = $this->getMockBuilder(TokenStorage::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->usernamePasswordTokenMock = $this->getMockBuilder(UsernamePasswordToken::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->parameterBagMock = $this->getMockBuilder(ParameterBag::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestMock->attributes = $this->parameterBagMock;
        $this->requestMock->query = new InputBag(['callback_url' => 'test']);

        $this->accessTokenController = new class (
            $this->customerTokenManagerFactoryMock,
            $this->applicationMock,
            $this->chainRouterMock
        ) extends AccessTokenController
        {
            /**
             * @var \Spryker\Yves\Kernel\AbstractFactory
             */
            private $customerTokenManagerFactory;

            /**
             * @var \Spryker\Yves\Router\Router\ChainRouter
             */
            private $chainRouter;

            /**
             * @param \Spryker\Yves\Kernel\AbstractFactory $customerTokenManagerFactory
             * @param \Spryker\Yves\Kernel\Application $application
             * @param \Spryker\Yves\Router\Router\ChainRouter $chainRouter
             */
            public function __construct(
                AbstractFactory $customerTokenManagerFactory,
                Application $application,
                ChainRouter $chainRouter
            ) {
                $this->customerTokenManagerFactory = $customerTokenManagerFactory;
                $this->application = $application;
                $this->chainRouter = $chainRouter;
            }

            /**
             * @return \Spryker\Yves\Kernel\AbstractFactory
             */
            public function getFactory(): AbstractFactory
            {
                return $this->customerTokenManagerFactory;
            }

            /**
             * @return \Spryker\Yves\Kernel\Application|\Spryker\Service\Container\ContainerInterface
             */
            protected function getApplication()
            {
                return $this->application;
            }

            /**
             * @return \Symfony\Cmf\Component\Routing\ChainRouterInterface
             */
            protected function getRouter(): ChainRouterInterface
            {
                return $this->chainRouter;
            }
        };
    }

    /**
     * @return void
     */
    public function testTokenManagerAction(): void
    {
        $token = 'token_token_token';

        $this->customerTokenManagerFactoryMock->expects(static::atLeastOnce())
            ->method('getCustomerClient')
            ->willReturn($this->customerClientMock);

        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('isLoggedIn')
            ->willReturn(false);

        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('getCustomerByAccessToken')
            ->with($token)
            ->willReturn($this->customerResponseTransferMock);

        $this->customerResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(true);

        $this->customerResponseTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerTransfer')
            ->willReturn($this->customerTransferMock);

        $this->customerTokenManagerFactoryMock->expects(static::atLeastOnce())
            ->method('createUsernamePasswordToken')
            ->with($this->customerTransferMock)
            ->willReturn($this->usernamePasswordTokenMock);

        $this->customerTokenManagerFactoryMock->expects(static::atLeastOnce())
            ->method('getTokenStorage')
            ->willReturn($this->tokenStorageMock);

        $this->tokenStorageMock->expects(static::atLeastOnce())
            ->method('setToken')
            ->with($this->usernamePasswordTokenMock);

        $this->customerTokenManagerFactoryMock->expects(static::atLeastOnce())
            ->method('createCustomerAuthenticator')
            ->willReturn($this->customerAuthenticatorMock);

        $this->customerAuthenticatorMock->expects(static::atLeastOnce())
            ->method('authenticateCustomer')
            ->with($this->customerTransferMock, $this->usernamePasswordTokenMock);

        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('setCustomer')
            ->with($this->customerTransferMock);

        $this->parameterBagMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(['language'])
            ->willReturnOnConsecutiveCalls(
                'de',
            );

        static::assertInstanceOf(
            RedirectResponse::class,
            $this->accessTokenController->tokenManagerAction($this->requestMock, $token),
        );
    }

    /**
     * @return void
     */
    public function testTokenManagerActionUserAlreadyLoggedIn(): void
    {
        $token = 'token_token_token';

        $this->customerTokenManagerFactoryMock->expects(static::atLeastOnce())
            ->method('getCustomerClient')
            ->willReturn($this->customerClientMock);

        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('isLoggedIn')
            ->willReturn(true);

        $this->customerClientMock->expects(static::never())
            ->method('getCustomerByAccessToken')
            ->with($token)
            ->willReturn($this->customerResponseTransferMock);

        $this->parameterBagMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(['language'])
            ->willReturnOnConsecutiveCalls(
                'de',
            );

        static::assertInstanceOf(
            RedirectResponse::class,
            $this->accessTokenController->tokenManagerAction($this->requestMock, $token),
        );
    }

    /**
     * @return void
     */
    public function testTokenManagerActionInvalidToken(): void
    {
        $token = 'invalid_token';

        $this->customerTokenManagerFactoryMock->expects(static::atLeastOnce())
            ->method('getCustomerClient')
            ->willReturn($this->customerClientMock);

        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('isLoggedIn')
            ->willReturn(false);

        $this->customerClientMock->expects(static::atLeastOnce())
            ->method('getCustomerByAccessToken')
            ->with($token)
            ->willReturn($this->customerResponseTransferMock);

        $this->customerResponseTransferMock->expects(static::atLeastOnce())
            ->method('getIsSuccess')
            ->willReturn(false);

        $this->customerTokenManagerFactoryMock->expects(static::atLeastOnce())
            ->method('showErrorMessageOnExpiredLogin')
            ->willReturn(false);

        $this->customerTokenManagerFactoryMock->expects(static::atLeastOnce())
            ->method('getYvesBaseUrl')
            ->willReturn('/');

        $this->customerTokenManagerFactoryMock->expects(static::atLeastOnce())
            ->method('getRedirectPathAfterExpiredLogin')
            ->willReturn('/');

        $this->parameterBagMock->expects(static::atLeastOnce())
            ->method('get')
            ->withConsecutive(['language'])
            ->willReturnOnConsecutiveCalls(
                'de',
            );

        static::assertInstanceOf(
            RedirectResponse::class,
            $this->accessTokenController->tokenManagerAction($this->requestMock, $token),
        );
    }
}
