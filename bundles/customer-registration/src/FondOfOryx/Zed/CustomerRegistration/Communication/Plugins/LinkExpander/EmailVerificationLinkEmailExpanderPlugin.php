<?php

namespace FondOfOryx\Zed\CustomerRegistration\Communication\Plugins\LinkExpander;

use FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\EmailVerificationLinkExpanderPluginInterface;
use Generated\Shared\Transfer\CustomerTransfer;

class EmailVerificationLinkEmailExpanderPlugin implements EmailVerificationLinkExpanderPluginInterface
{
    /**
     * @var string
     */
    protected const EMAIL_PATTERN = '{{email}}';

    /**
     * @param string $link
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string
     */
    public function expand(string $link, CustomerTransfer $customerTransfer): string
    {
        return str_replace(static::EMAIL_PATTERN, $customerTransfer->getEmail(), $link);
    }
}
