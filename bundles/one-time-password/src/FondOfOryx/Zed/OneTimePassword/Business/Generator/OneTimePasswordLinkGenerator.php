<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class OneTimePasswordLinkGenerator implements OneTimePasswordLinkGeneratorInterface
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface
     */
    protected $oneTimePasswordGenerator;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface
     */
    protected $oneTimePasswordEncoder;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig
     */
    protected $oneTimePasswordConfig;

    /**
     * @param \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface $oneTimePasswordGenerator
     * @param \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface $oneTimePasswordEncoder
     * @param \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig $oneTimePasswordConfig
     */
    public function __construct(
        OneTimePasswordGeneratorInterface $oneTimePasswordGenerator,
        OneTimePasswordEncoderInterface $oneTimePasswordEncoder,
        OneTimePasswordConfig $oneTimePasswordConfig
    ) {
        $this->oneTimePasswordGenerator = $oneTimePasswordGenerator;
        $this->oneTimePasswordEncoder = $oneTimePasswordEncoder;
        $this->oneTimePasswordConfig = $oneTimePasswordConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string|null
     */
    public function generateLoginLink(
        CustomerTransfer $customerTransfer
    ): ?string {
        $oneTimePasswordResponseTransfer = $this->oneTimePasswordGenerator->generateOneTimePassword($customerTransfer);

        if (!$oneTimePasswordResponseTransfer->getIsSuccess()) {
            return null;
        }

        $encodedLoginCredentials = $this->oneTimePasswordEncoder->encode($oneTimePasswordResponseTransfer);

        return sprintf(
            '%s?%s=%s',
            $this->oneTimePasswordConfig->getLoginLinkPath(),
            $this->oneTimePasswordConfig->getLoginLinkParameterName(),
            $encodedLoginCredentials
        );
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return string|null
     */
    public function generateLoginLinkWithOrderReference(
        OrderTransfer $orderTransfer
    ): ?string {
        $customerTransfer = $orderTransfer->getCustomer();

        if (!$customerTransfer) {
            return null;
        }

        $credentialsLink = $this->generateLoginLink($customerTransfer);

        if (!$credentialsLink) {
            return null;
        }

        return sprintf(
            '%s&%s=%s',
            $credentialsLink,
            $this->oneTimePasswordConfig->getLoginLinkOrderReferenceName(),
            $orderTransfer->getOrderReference()
        );
    }
}
