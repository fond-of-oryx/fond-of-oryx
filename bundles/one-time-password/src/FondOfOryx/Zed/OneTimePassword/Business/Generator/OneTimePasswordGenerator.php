<?php

namespace FondOfOryx\Zed\OneTimePassword\Business\Generator;

use FondOfOryx\Zed\OneTimePassword\OneTimePasswordConfig;
use FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface;
use FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordQueryContainerInterface;
use Generated\Shared\Transfer\CustomerResponseTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Hackzilla\PasswordGenerator\Generator\HumanPasswordGenerator;
use Orm\Zed\Customer\Persistence\SpyCustomer;
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
     * @var \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordQueryContainerInterface
     */
    protected $oneTimePasswordQueryContainer;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface
     */
    protected $oneTimePasswordEntityManager;

    /**
     * @param \Hackzilla\PasswordGenerator\Generator\HumanPasswordGenerator $humanPasswordGenerator
     * @param \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordQueryContainerInterface $oneTimePasswordQueryContainer
     * @param \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordEntityManagerInterface $oneTimePasswordEntityManager
     */
    public function __construct(
        HumanPasswordGenerator $humanPasswordGenerator,
        OneTimePasswordQueryContainerInterface $oneTimePasswordQueryContainer,
        OneTimePasswordEntityManagerInterface $oneTimePasswordEntityManager
    ) {
        $this->humanPasswordGenerator = $humanPasswordGenerator;
        $this->oneTimePasswordQueryContainer = $oneTimePasswordQueryContainer;
        $this->oneTimePasswordEntityManager = $oneTimePasswordEntityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerResponseTransfer
     */
    public function generateOneTimePassword(CustomerTransfer $customerTransfer): CustomerResponseTransfer
    {
        $customerTransfer->requireEmail();

        $customerTransfer->setNewPassword($this->generateNewEncodedPassword());

        $customerEntity = $this->getCustomer($customerTransfer);

        $customerEntity->setPassword($customerTransfer->getNewPassword());

        $changedRows = $customerEntity->save();

        $customerTransfer->fromArray($customerEntity->toArray(), true);

        return (new CustomerResponseTransfer())
            ->setIsSuccess($changedRows > 0)
            ->setCustomerTransfer($customerTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomer
     */
    protected function getCustomer(CustomerTransfer $customerTransfer): SpyCustomer
    {
        return $this->oneTimePasswordQueryContainer
            ->queryCustomerByEmail($customerTransfer->getEmail())
            ->findOne();
    }

    /**
     * @return string
     */
    protected function generateNewEncodedPassword(): string
    {
        return $this->getEncodedPassword(
            $this->generateNewPassword()
        );
    }

    /**
     * @return string
     */
    protected function generateNewPassword(): string
    {
        return $this->humanPasswordGenerator
            ->setWordList(__DIR__ . OneTimePasswordConfig::GERMAN_WORD_LIST_PATH)
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

        return $encoder->encodePassword($currentPassword, self::BCRYPT_SALT);
    }
}
