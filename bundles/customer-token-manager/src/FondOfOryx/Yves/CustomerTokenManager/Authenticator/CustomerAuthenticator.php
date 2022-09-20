<?php

namespace FondOfOryx\Yves\CustomerTokenManager\Authenticator;

use FondOfOryx\Yves\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CustomerAuthenticator implements CustomerAuthenticatorInterface
{
    /**
     * @var \FondOfOryx\Yves\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientInterface
     */
    protected $customerClient;

    /**
     * @var \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @param \FondOfOryx\Yves\CustomerTokenManager\Dependency\Client\CustomerTokenManagerToCustomerClientInterface $customerClient
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage
     */
    public function __construct(
        CustomerTokenManagerToCustomerClientInterface $customerClient,
        TokenStorageInterface $tokenStorage
    ) {
        $this->customerClient = $customerClient;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
     *
     * @return void
     */
    public function authenticateCustomer(CustomerTransfer $customerTransfer, TokenInterface $token): void
    {
        $this->tokenStorage->setToken($token);
        $this->customerClient->setCustomer($customerTransfer);
    }
}
