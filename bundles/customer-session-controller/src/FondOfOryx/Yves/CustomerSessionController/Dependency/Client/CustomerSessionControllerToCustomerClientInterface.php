<?php

namespace FondOfOryx\Yves\CustomerSessionController\Dependency\Client;

use Generated\Shared\Transfer\CustomerResponseTransfer;

interface CustomerSessionControllerToCustomerClientInterface
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
