<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface;
use Generated\Shared\Transfer\CustomerTransfer;

interface OneTimePasswordLinkGeneratorInterface
{
    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface $oneTimePasswordEncoder
     *
     * @return string|null
     */
    public function generateLoginLink(
        CustomerTransfer $customerTransfer,
        OneTimePasswordEncoderInterface $oneTimePasswordEncoder
    ): ?string;
}
