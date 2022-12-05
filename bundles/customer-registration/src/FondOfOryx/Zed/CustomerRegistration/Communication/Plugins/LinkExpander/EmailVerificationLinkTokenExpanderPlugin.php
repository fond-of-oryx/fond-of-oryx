<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\LinkExpander;

use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\EmailVerificationLinkExpanderPluginInterface;
use Generated\Shared\Transfer\CustomerTransfer;

class EmailVerificationLinkTokenExpanderPlugin implements EmailVerificationLinkExpanderPluginInterface
{
    /**
     * @var string
     */
    protected const TOKEN_PATTERN = '{{token}}';

    /**
     * @param string $link
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string
     */
    public function expand(string $link, CustomerTransfer $customerTransfer): string
    {
        return str_replace(static::TOKEN_PATTERN, $customerTransfer->getRegistrationKey(), $link);
    }
}
