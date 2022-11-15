<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Steps;

use Exception;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\CustomerReferenceGeneratorInterface;
use FondOfOryx\Zed\CustomerRegistration\Business\Generator\PasswordGeneratorInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Encoder\CustomerRegistrationToPasswordEncoderInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface;
use Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class RegistrationStep extends AbstractStep implements RegistrationStepInterface
{
    /**
     * @var string
     */
    protected const BCRYPT_SALT = '';

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface
     */
    protected $customerFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Encoder\CustomerRegistrationToPasswordEncoderInterface
     */
    protected $passwordEncoder;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Generator\PasswordGeneratorInterface
     */
    protected $passwordGenerator;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Generator\CustomerReferenceGeneratorInterface
     */
    protected $customerReferenceGenerator;

    /**
     * @var array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected $postStepPlugins;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\Business\Generator\PasswordGeneratorInterface $passwordGenerator
     * @param \FondOfOryx\Zed\CustomerRegistration\Business\Generator\CustomerReferenceGeneratorInterface $customerReferenceGenerator
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToCustomerFacadeInterface $customerFacade
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface $localeFacade
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Encoder\CustomerRegistrationToPasswordEncoderInterface $passwordEncoder
     * @param \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface $entityManager
     * @param array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface> $postStepPlugins
     */
    public function __construct(
        PasswordGeneratorInterface $passwordGenerator,
        CustomerReferenceGeneratorInterface $customerReferenceGenerator,
        CustomerRegistrationToCustomerFacadeInterface $customerFacade,
        CustomerRegistrationToLocaleFacadeInterface $localeFacade,
        CustomerRegistrationToPasswordEncoderInterface $passwordEncoder,
        CustomerRegistrationEntityManagerInterface $entityManager,
        array $postStepPlugins
    ) {
        $this->passwordGenerator = $passwordGenerator;
        $this->customerReferenceGenerator = $customerReferenceGenerator;
        $this->customerFacade = $customerFacade;
        $this->localeFacade = $localeFacade;
        $this->passwordEncoder = $passwordEncoder;
        $this->entityManager = $entityManager;
        $this->postStepPlugins = $postStepPlugins;
    }

    /**
     * @param string $email
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function findCustomer(string $email): ?CustomerTransfer
    {
        try {
            return $this->customerFacade->getCustomer((new CustomerTransfer())->setEmail($email));
        } catch (Exception $exception) {
            return null;
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function register(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        $bag = $this->getBag($customerRegistrationRequestTransfer);
        $bag->setIsNewCustomer(false);

        $attributes = $customerRegistrationRequestTransfer->getAttributesOrFail();
        if ($attributes->getEmail() === null) {
            return $this->executePostStepPlugins($customerRegistrationRequestTransfer->setBag($bag));
        }

        $customer = $this->findCustomer($attributes->getEmail());
        if ($customer === null) {
            $bag->setIsNewCustomer(true);
            $customer = $this->createCustomer($attributes);
        }

        return $this->executePostStepPlugins($customerRegistrationRequestTransfer->setBag($bag->setCustomer($customer)));
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer $attributesTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    protected function createCustomer(CustomerRegistrationAttributesTransfer $attributesTransfer): CustomerTransfer
    {
        $locale = $this->localeFacade->getLocale($attributesTransfer->getLanguage());

        $customerTransfer = (new CustomerTransfer())
            ->setEmail($attributesTransfer->getEmail())
            ->setLocale($locale);

        $customerTransfer = $this->encodePassword($customerTransfer);
        $customerTransfer
            ->setCustomerReference($this->customerReferenceGenerator->generateCustomerReference())
            ->setRegistrationKey($this->passwordGenerator->generateRandomString());

        return $this->entityManager->createCustomer($customerTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    protected function encodePassword(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        $currentPassword = $customerTransfer->getPassword();
        if ($currentPassword === null) {
            $currentPassword = $this->passwordGenerator->generate();
        }

        $customerTransfer->setPassword($this->passwordEncoder->encodePassword($currentPassword, static::BCRYPT_SALT));

        return $customerTransfer;
    }
}
