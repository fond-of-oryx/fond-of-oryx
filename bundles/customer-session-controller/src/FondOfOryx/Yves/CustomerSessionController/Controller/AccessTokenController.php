<?php

namespace FondOfOryx\Yves\CustomerSessionController\Controller;

use FondOfOryx\Shared\CustomerSessionController\CustomerSessionControllerConstants;
use Spryker\Client\Kernel\AbstractClient;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * @method \FondOfOryx\Yves\CustomerSessionController\CustomerSessionControllerFactory getFactory()
 */
class AccessTokenController extends AbstractController
{
    /**
     * @param string $token
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tokenManagerAction(string $token): Response
    {
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
            $this->addErrorMessage(CustomerSessionControllerConstants::GLOSSARY_KEY_CUSTOMER_ALREADY_LOGGED_IN);

            return $this->redirectResponseInternal(CustomerSessionControllerConstants::ROUTE_CUSTOMER_OVERVIEW);
        }

        $customerResponseTransfer = $this->getFactory()
            ->getCustomerClient()
            ->getCustomerByAccessToken($token);

        if (!$customerResponseTransfer->getIsSuccess()) {
            $this->addErrorMessage(CustomerSessionControllerConstants::GLOSSARY_KEY_INVALID_ACCESS_TOKEN);

            throw new AccessDeniedHttpException();
        }

        $customerTransfer = $customerResponseTransfer->getCustomerTransfer();
        $token = $this->getFactory()->createUsernamePasswordToken($customerTransfer);

        $this->getFactory()
            ->createCustomerAuthenticator()
            ->authenticateCustomer($customerTransfer, $token);

        return $this->redirectResponseInternal(CustomerSessionControllerConstants::ROUTE_CUSTOMER_OVERVIEW);
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
