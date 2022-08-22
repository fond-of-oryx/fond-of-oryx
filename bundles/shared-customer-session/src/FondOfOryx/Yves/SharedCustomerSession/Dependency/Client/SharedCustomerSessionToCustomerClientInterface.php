<?php

namespace FondOfOryx\Yves\SharedCustomerSession\Dependency\Client;

use Generated\Shared\Transfer\CustomerResponseTransfer;

interface SharedCustomerSessionToCustomerClientInterface
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
}
