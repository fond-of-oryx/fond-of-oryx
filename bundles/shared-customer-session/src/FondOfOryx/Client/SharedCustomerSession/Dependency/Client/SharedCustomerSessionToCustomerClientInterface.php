<?php

namespace FondOfOryx\Client\SharedCustomerSession\Dependency\Client;

use Generated\Shared\Transfer\CustomerResponseTransfer;

interface SharedCustomerSessionToCustomerClientInterface
{
    /**
     * @param string $accessToken
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function getCustomerByAccessToken(string $accessToken): CustomerResponseTransfer;
}
