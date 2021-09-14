<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class OneTimePasswordLinkGenerator implements OneTimePasswordLinkGeneratorInterface
{
    protected const LINK_PARAMETER_FORMAT = '%s?%s=%s';
    protected const LINK_PARAMETER_EXTENSION_FORMAT = '%s&%s=%s';

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Generator\OneTimePasswordGeneratorInterface
     */
    protected $oneTimePasswordGenerator;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Business\Encoder\OneTimePasswordEncoderInterface
     */
    protected $oneTimePasswordEncoder;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\Facade\OneTimePasswordToOauthFacadeInterface
     */
    protected $oauthFacade;

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
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function generateLoginLink(
        CustomerTransfer $customerTransfer
    ): OneTimePasswordResponseTransfer {
        $oneTimePasswordResponseTransfer = $this->oneTimePasswordGenerator->generateOneTimePassword($customerTransfer);

        if (!$oneTimePasswordResponseTransfer->getIsSuccess()) {
            return $oneTimePasswordResponseTransfer;
        }

        $encodedLoginCredentials = $this->oneTimePasswordEncoder->encode($oneTimePasswordResponseTransfer);

        if ($encodedLoginCredentials === null) {
            return $oneTimePasswordResponseTransfer->setIsSuccess(false);
        }

        $loginLink = sprintf(
            self::LINK_PARAMETER_FORMAT,
            $this->oneTimePasswordConfig->getLoginLinkPath(),
            $this->oneTimePasswordConfig->getLoginLinkParameterName(),
            $encodedLoginCredentials
        );

        return $oneTimePasswordResponseTransfer
            ->setLoginLink($loginLink);
    }

    /**
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function generateLoginLinkWithOrderReference(
        OrderTransfer $orderTransfer
    ): OneTimePasswordResponseTransfer {
        $customerTransfer = $orderTransfer->requireCustomer()->getCustomer();

        $oneTimePasswordResponseTransfer = $this->generateLoginLink($customerTransfer);

        if (!$oneTimePasswordResponseTransfer->getIsSuccess()) {
            return $oneTimePasswordResponseTransfer;
        }

        $loginLink = sprintf(
            self::LINK_PARAMETER_EXTENSION_FORMAT,
            $oneTimePasswordResponseTransfer->getLoginLink(),
            $this->oneTimePasswordConfig->getLoginLinkOrderReferenceName(),
            $orderTransfer->getOrderReference()
        );

        return $oneTimePasswordResponseTransfer
            ->setLoginLink($loginLink);
    }
}
