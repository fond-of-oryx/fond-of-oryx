<?php

namespace FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin;

use Generated\Shared\Transfer\CustomerTransfer;

interface EmailVerificationLinkExpanderPluginInterface
{
    /**
     * @param string $link
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string
     */
    public function expand(string $link, CustomerTransfer $customerTransfer): string;
}
