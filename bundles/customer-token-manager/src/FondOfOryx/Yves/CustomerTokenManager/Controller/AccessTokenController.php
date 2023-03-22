<?php

namespace FondOfOryx\Yves\CustomerTokenManager\Controller;

use FondOfOryx\Shared\CustomerTokenManager\CustomerTokenManagerConstants;
use Spryker\Yves\Kernel\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method \FondOfOryx\Yves\CustomerTokenManager\CustomerTokenManagerFactory getFactory()
 */
class AccessTokenController extends AbstractController
{
    /**
     * @var string|null
     */
    protected $callback_url;

    /**
     * @var string|null
     */
    protected $language;

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param string $token
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tokenManagerAction(Request $request, string $token): Response
    {
        $this->callback_url = $this->cleanSlashes($request->query->get('callback_url'));
        $this->language = $this->cleanSlashes($request->attributes->get('language'));

        return $this->executeTokenManagerAction($token);
    }

    /**
     * @param string $token
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function executeTokenManagerAction(string $token): RedirectResponse
    {
        // This is necessary to include the token in the redirect
        $accessToken = $token;

        if ($this->isLoggedInCustomer()) {
            $this->addSuccessMessage(CustomerTokenManagerConstants::GLOSSARY_KEY_CUSTOMER_LOGGED_IN);

            return $this->createRedirectResponse($accessToken);
        }

        $customerResponseTransfer = $this->getFactory()
            ->getCustomerClient()
            ->getCustomerByAccessToken($token);

        if (!$customerResponseTransfer->getIsSuccess()) {
            if ($this->getFactory()->showErrorMessageOnExpiredLogin()) {
                $this->addErrorMessage(CustomerTokenManagerConstants::GLOSSARY_KEY_INVALID_ACCESS_TOKEN);
            }

            return $this->redirectResponseExternal($this->determineExpiredTargetUrl());
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

        $this->addSuccessMessage(CustomerTokenManagerConstants::GLOSSARY_KEY_CUSTOMER_LOGGED_IN);

        return $this->createRedirectResponse($accessToken);
    }

    /**
     * @return bool
     */
    protected function isLoggedInCustomer(): bool
    {
        return $this->getFactory()->getCustomerClient()->isLoggedIn();
    }

    /**
     * Todo: Evaluate if callback URL could be a full URL and validated by
     *      Sprykers whitelist domain logic
     *
     * @return string
     */
    protected function determineTargetUrl(): string
    {
        $baseUrl = $this->cleanSlashes($this->getFactory()->getYvesBaseUrl());
        if ($this->callback_url && $this->language) {
            return sprintf('%s/%s/%s', $baseUrl, $this->language, $this->callback_url);
        }

        if ($this->callback_url) {
            return sprintf('%s/%s', $baseUrl, $this->callback_url);
        }

        $default = $this->cleanSlashes($this->getFactory()->getRedirectPathAfterLogin());

        if ($this->language) {
            return sprintf('%s/%s/%s', $baseUrl, $this->language, $default);
        }

        return sprintf('%s/%s', $baseUrl, $default);
    }

    /**
     * @return string
     */
    protected function determineExpiredTargetUrl(): string
    {
        $baseUrl = $this->cleanSlashes($this->getFactory()->getYvesBaseUrl());
        $default = $this->cleanSlashes($this->getFactory()->getRedirectPathAfterExpiredLogin());

        if ($this->language) {
            return sprintf('%s/%s/%s', $baseUrl, $this->language, $default);
        }

        return sprintf('%s/%s', $baseUrl, $default);
    }

    /**
     * @param string $token
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function createRedirectResponse(string $token): RedirectResponse
    {
        return $this->redirectResponseExternal(
            sprintf(
                '%s?%s=%s',
                $this->determineTargetUrl(),
                $this->getFactory()->getSignatureParameterName(),
                $token,
            ),
        );
    }

    /**
     * @param string|null $string
     *
     * @return string|null
     */
    protected function cleanSlashes(?string $string): ?string
    {
        if ($string === null) {
            return null;
        }

        return ltrim(rtrim($string, '/'), '/');
    }
}
