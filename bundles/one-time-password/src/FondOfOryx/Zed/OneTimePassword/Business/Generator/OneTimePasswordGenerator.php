<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Hackzilla\PasswordGenerator\Generator\HybridPasswordGenerator;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;

class OneTimePasswordGenerator implements OneTimePasswordGeneratorInterface
{
    /**
     * @var string
     */
    protected const BCRYPT_SALT = '';

    /**
     * @var \Hackzilla\PasswordGenerator\Generator\HybridPasswordGenerator
     */
    protected $hybridPasswordGenerator;

    /**
     * @var \Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface
     */
    protected PasswordEncoderInterface $passwordHasher;

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
     * @param \Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface $passwordHasher
     * @param \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface $oneTimePasswordEntityManager
     * @param \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig $oneTimePasswordConfig
     */
    public function __construct(
        HybridPasswordGenerator $hybridPasswordGenerator,
        PasswordEncoderInterface $passwordHasher,
        OneTimePasswordEntityManagerInterface $oneTimePasswordEntityManager,
        OneTimePasswordConfig $oneTimePasswordConfig
    ) {
        $this->hybridPasswordGenerator = $hybridPasswordGenerator;
        $this->passwordHasher = $passwordHasher;
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

        $customerTransfer->setNewPassword($this->passwordHasher->encodePassword($password, static::BCRYPT_SALT));

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
}
