<?php

namespace FondOfOryx\Yves\CustomerTokenManager\Controller;

use FondOfOryx\Shared\CustomerTokenManager\CustomerTokenManagerConstants;
use Spryker\Client\Kernel\AbstractClient;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * @method \FondOfOryx\Yves\CustomerTokenManager\CustomerTokenManagerFactory getFactory()
 */
class AccessTokenController extends AbstractController
{
    /**
     * @var string|null
     */
    private $callback_url;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $token
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tokenManagerAction(Request $request, string $token): Response
    {
        $this->callback_url = $request->query->get('callback_url');

        return $this->executeTokenManagerAction($token);
    }

    /**
     * @param string $token
     *
     * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function executeTokenManagerAction(string $token): RedirectResponse
    {
        if ($this->isLoggedInCustomer()) {
            $this->addErrorMessage(CustomerTokenManagerConstants::GLOSSARY_KEY_CUSTOMER_ALREADY_LOGGED_IN);

            return $this->redirectResponseInternal(
                $this->callback_url ?? $this->getFactory()->getRedirectUrlAfterLogin(),
                ['query' => ['signature' => $token]],
            );
        }

        $customerResponseTransfer = $this->getFactory()
            ->getCustomerClient()
            ->getCustomerByAccessToken($token);

        if (!$customerResponseTransfer->getIsSuccess()) {
            $this->addErrorMessage(CustomerTokenManagerConstants::GLOSSARY_KEY_INVALID_ACCESS_TOKEN);

            throw new AccessDeniedHttpException();
        }

        $customerTransfer = $customerResponseTransfer->getCustomerTransfer();
        $token = $this->getFactory()->createUsernamePasswordToken($customerTransfer);

        $this->getFactory()
            ->getTokenStorage()
            ->setToken($token);

        $this->getFactory()
            ->createCustomerAuthenticator()
            ->authenticateCustomer($customerTransfer, $token);

        $this->getFactory()
            ->getCustomerClient()
            ->setCustomer($customerTransfer);

        return $this->redirectResponseInternal(
            $this->callback_url ?? $this->getFactory()->getRedirectUrlAfterLogin(),
            ['query' => ['signature' => $token]],
        );
    }

    /**
     * @return bool
     */
    protected function isLoggedInCustomer(): bool
    {
        return $this->getFactory()->getCustomerClient()->isLoggedIn();
    }

    /**
     * @return \Spryker\Client\Kernel\AbstractClient
     */
    public function getClient(): AbstractClient
    {
        return $this->client;
    }
}
