<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Encoder;

use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;

class OneTimePasswordBase64Encoder implements OneTimePasswordEncoderInterface
{
    /**
     * @param \Generated\Shared\Transfer\OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer
     *
     * @return string
     */
    public function encode(OneTimePasswordResponseTransfer $oneTimePasswordResponseTransfer): string
    {
        $customerTransfer = $oneTimePasswordResponseTransfer->getCustomerTransfer();

        $loginCredentials = sprintf(
            '%s:%s',
            $customerTransfer->getEmail(),
            $oneTimePasswordResponseTransfer->getOneTimePasswordPlain(),
        );

        return base64_encode($loginCredentials);
    }
}
