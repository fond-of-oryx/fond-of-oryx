<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use Generated\Shared\Transfer\CustomerTransfer;

class OneTimePasswordLinkGenerator implements OneTimePasswordLinkGeneratorInterface
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface
     */
    protected $oneTimePasswordGenerator;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig
     */
    protected $oneTimePasswordConfig;

    /**
     * @param \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface $oneTimePasswordGenerator
     * @param \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig $oneTimePasswordConfig
     */
    public function __construct(
        OneTimePasswordGeneratorInterface $oneTimePasswordGenerator,
        OneTimePasswordConfig $oneTimePasswordConfig
    ) {
        $this->oneTimePasswordGenerator = $oneTimePasswordGenerator;
        $this->oneTimePasswordConfig = $oneTimePasswordConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface $oneTimePasswordEncoder
     *
     * @return string|null
     */
    public function generateLoginLink(
        CustomerTransfer $customerTransfer,
        OneTimePasswordEncoderInterface $oneTimePasswordEncoder
    ): ?string {
        $oneTimePasswordResponseTransfer = $this->oneTimePasswordGenerator->generateOneTimePassword($customerTransfer);

        if (!$oneTimePasswordResponseTransfer->getIsSuccess()) {
            return null;
        }

        $encodedLoginCredentials = $oneTimePasswordEncoder->encode($oneTimePasswordResponseTransfer);

        return sprintf(
            '%s?%s=%s',
            $this->oneTimePasswordConfig->getAutoLoginPath(),
            $this->oneTimePasswordConfig->getAutoLoginParameterName(),
            $encodedLoginCredentials
        );
    }
}
