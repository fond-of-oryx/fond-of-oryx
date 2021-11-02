<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Hackzilla\PasswordGenerator\Generator\HybridPasswordGenerator;
use Symfony\Component\Security\Core\Encoder\NativePasswordEncoder;

class OneTimePasswordGenerator implements OneTimePasswordGeneratorInterface
{
    /**
     * @var int
     */
    protected const BCRYPT_FACTOR = 12;

    /**
     * @var string
     */
    protected const BCRYPT_SALT = '';

    /**
     * @var \Hackzilla\PasswordGenerator\Generator\HybridPasswordGenerator
     */
    protected $hybridPasswordGenerator;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface
     */
    protected $oneTimePasswordEntityManager;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig
     */
    protected $oneTimePasswordConfig;

    /**
     * @param \Hackzilla\PasswordGenerator\Generator\HybridPasswordGenerator $hybridPasswordGenerator
     * @param \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface $oneTimePasswordEntityManager
     * @param \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig $oneTimePasswordConfig
     */
    public function __construct(
        HybridPasswordGenerator $hybridPasswordGenerator,
        OneTimePasswordEntityManagerInterface $oneTimePasswordEntityManager,
        OneTimePasswordConfig $oneTimePasswordConfig
    ) {
        $this->hybridPasswordGenerator = $hybridPasswordGenerator;
        $this->oneTimePasswordEntityManager = $oneTimePasswordEntityManager;
        $this->oneTimePasswordConfig = $oneTimePasswordConfig;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\OneTimePasswordResponseTransfer
     */
    public function generateOneTimePassword(CustomerTransfer $customerTransfer): OneTimePasswordResponseTransfer
    {
        $customerTransfer->requireEmail();

        $password = $this->generateNewPassword();

        $customerTransfer->setNewPassword($this->getEncodedPassword($password));

        $customerResponseTransfer = $this->oneTimePasswordEntityManager->updateCustomerPassword($customerTransfer);

        return (new OneTimePasswordResponseTransfer())
            ->setIsSuccess($customerResponseTransfer->getIsSuccess())
            ->setCustomerTransfer($customerResponseTransfer->getCustomerTransfer())
            ->setOneTimePasswordPlain($password);
    }

    /**
     * @return string
     */
    protected function generateNewPassword(): string
    {
        return $this->hybridPasswordGenerator
            ->setUppercase($this->oneTimePasswordConfig->getPasswordGeneratorUppercase())
            ->setLowercase($this->oneTimePasswordConfig->getPasswordGeneratorLowercase())
            ->setNumbers($this->oneTimePasswordConfig->getPasswordGeneratorNumbers())
            ->setSymbols($this->oneTimePasswordConfig->getPasswordGeneratorSymbols())
            ->setSegmentLength($this->oneTimePasswordConfig->getPasswordGeneratorSegmentLength())
            ->setSegmentCount($this->oneTimePasswordConfig->getPasswordGeneratorSegmentCount())
            ->setSegmentSeparator($this->oneTimePasswordConfig->getPasswordGeneratorSegmentSeparator())
            ->generatePassword();
    }

    /**
     * @param string $currentPassword
     *
     * @return string
     */
    protected function getEncodedPassword(string $currentPassword): string
    {
        $encoder = new NativePasswordEncoder(null, null, static::BCRYPT_FACTOR);

        return $encoder->encodePassword($currentPassword, static::BCRYPT_SALT);
    }
}
