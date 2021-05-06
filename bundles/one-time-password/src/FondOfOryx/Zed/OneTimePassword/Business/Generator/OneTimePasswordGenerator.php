<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\OneTimePasswordResponseTransfer;
use Hackzilla\PasswordGenerator\Generator\HumanPasswordGenerator;
use Symfony\Component\Security\Core\Encoder\NativePasswordEncoder;

class OneTimePasswordGenerator implements OneTimePasswordGeneratorInterface
{
    protected const BCRYPT_FACTOR = 12;
    protected const BCRYPT_SALT = '';

    /**
     * @var \Hackzilla\PasswordGenerator\Generator\HumanPasswordGenerator
     */
    protected $humanPasswordGenerator;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface
     */
    protected $oneTimePasswordEntityManager;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig
     */
    protected $oneTimePasswordConfig;

    /**
     * @param \Hackzilla\PasswordGenerator\Generator\HumanPasswordGenerator $humanPasswordGenerator
     * @param \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface $oneTimePasswordEntityManager
     * @param \FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig $oneTimePasswordConfig
     */
    public function __construct(
        HumanPasswordGenerator $humanPasswordGenerator,
        OneTimePasswordEntityManagerInterface $oneTimePasswordEntityManager,
        OneTimePasswordConfig $oneTimePasswordConfig
    ) {
        $this->humanPasswordGenerator = $humanPasswordGenerator;
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
        $wordlistPath = APPLICATION_ROOT_DIR . DIRECTORY_SEPARATOR . $this->oneTimePasswordConfig->getGermanWordListPath();

        return $this->humanPasswordGenerator
            ->setWordList($wordlistPath)
            ->setWordCount(3)
            ->setWordSeparator('-')
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

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return string|null
     */
    public function generateSelfServiceLoginLink(CustomerTransfer $customerTransfer): ?string
    {
        $oneTimePasswordResponseTransfer = $this->generateOneTimePassword($customerTransfer);

        if (!$oneTimePasswordResponseTransfer->getIsSuccess()) {
            return null;
        }

        $customerTransfer = $oneTimePasswordResponseTransfer->getCustomerTransfer();

        $loginCredentials = "{$customerTransfer->getEmail()}:{$oneTimePasswordResponseTransfer->getOneTimePasswordPlain()}";

        $encodedLoginCredentials = base64_encode($loginCredentials);

        return "{$this->oneTimePasswordConfig->getAutoLoginPath()}?{$this->oneTimePasswordConfig->getAutoLoginParameterName()}={$encodedLoginCredentials}";
    }
}
