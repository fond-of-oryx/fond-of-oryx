<?php

namespace FondOfOryx\Yves\CustomerTokenManager\Authenticator;

use Generated\Shared\Transfer\CustomerTransfer;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

interface CustomerAuthenticatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param \Symfony\Component\Security\Core\Authentication\Token\TokenInterface $token
     *
     * @return void
     */
    public function authenticateCustomer(CustomerTransfer $customerTransfer, TokenInterface $token): void;
}
