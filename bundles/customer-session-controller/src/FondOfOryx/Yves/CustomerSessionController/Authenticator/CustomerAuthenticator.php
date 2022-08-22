<?php

namespace FondOfOryx\Yves\CustomerSessionController\Authenticator;

use FondOfOryx\Yves\CustomerSessionController\Dependency\Client\CustomerSessionControllerToCustomerClientInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CustomerAuthenticator implements CustomerAuthenticatorInterface
{
    /**
     * @var \SprykerShop\Yves\CustomerPage\Dependency\Client\CustomerPageToCustomerClientInterface
     */
    protected $customerClient;

    /**
     * @var \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface
     */
    protected $tokenStorage;

    /**
     * @param \FondOfOryx\Yves\CustomerSessionController\Dependency\Client\CustomerSessionControllerToCustomerClientInterface $customerClient
     * @param \Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface $tokenStorage
     */
    public function __construct(
        CustomerSessionControllerToCustomerClientInterface $customerClient,
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
