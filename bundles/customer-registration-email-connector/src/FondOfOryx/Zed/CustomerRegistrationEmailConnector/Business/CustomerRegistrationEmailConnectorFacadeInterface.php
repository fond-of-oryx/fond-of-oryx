<?php

namespace FondOfOryx\Zed\CustomerRegistrationEmailConnector\Business;

use Generated\Shared\Transfer\CustomerTransfer;

interface CustomerRegistrationEmailConnectorFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param string $link
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return void
     */
    public function sendWelcomeMail(CustomerTransfer $customerTransfer, string $link): void;
}
