<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Sender;

use FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class OneTimePasswordSender implements OneTimePasswordSenderInterface
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface
     */
    protected $oneTimePasswordGenerator;

    /**
     * @param \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface $oneTimePasswordGenerator
     */
    public function __construct(OneTimePasswordGeneratorInterface $oneTimePasswordGenerator)
    {
        $this->oneTimePasswordGenerator = $oneTimePasswordGenerator;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function requestOneTimePassword(
        CustomerTransfer $customerTransfer
    ): CustomerResponseTransfer {
        $customerTransfer->requireEmail();

        return $this->oneTimePasswordGenerator->generateOneTimePassword($customerTransfer);
    }
}
