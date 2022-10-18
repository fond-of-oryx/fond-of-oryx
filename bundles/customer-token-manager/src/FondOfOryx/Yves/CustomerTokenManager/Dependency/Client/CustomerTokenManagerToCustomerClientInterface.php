<?php

namespace FondOfOryx\Yves\CustomerTokenManager\Dependency\Client;

use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerTokenManagerToCustomerClientInterface
{
    /**
     * @return bool
     */
    public function isLoggedIn(): bool;

    /**
     * @param string $accessToken
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function getCustomerByAccessToken(string $accessToken): CustomerResponseTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomerByEmail(CustomerTransfer $customerTransfer): CustomerTransfer;

    /**
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function getCustomer(): CustomerTransfer;

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function setCustomer(CustomerTransfer $customerTransfer);

    /**
     * @return string
     */
    public function getCustomerSecuredPattern(): string;
}
