<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Steps;

use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface;
use Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;
use Generated\Shared\Transfer\CustomerTransfer;

class VerificationStep extends AbstractStep implements VerificationStepInterface
{
    /**
     * @var array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface>
     */
    protected $preStepPlugins;

    /**
     * @var array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface>
     */
    protected $postStepPlugins;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface
     */
    protected $repository;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface $repository
     * @param \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface $entityManager
     * @param array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPreStepConditionPluginInterface> $preStepPlugins
     * @param array<\FondOfOryx\Zed\CustomerRegistrationExtension\Dependency\Plugin\CustomerRegistrationPostStepPluginInterface> $postStepPlugins
     */
    public function __construct(
        CustomerRegistrationRepositoryInterface $repository,
        CustomerRegistrationEntityManagerInterface $entityManager,
        array $preStepPlugins,
        array $postStepPlugins
    ) {
        $this->preStepPlugins = $preStepPlugins;
        $this->postStepPlugins = $postStepPlugins;
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerRegistrationRequestTransfer
     */
    public function verifyEmail(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        $bag = $this->getBag($customerRegistrationRequestTransfer);
        $bag->setIsVerified(false);

        if ($this->checkPreConditions($customerRegistrationRequestTransfer) === false) {
            return $this->executePostStepPlugins($customerRegistrationRequestTransfer->setBag($bag->setIsVerified($bag->getCustomerOrFail()->getIsVerified() === true)));
        }

        $customer = $bag->getCustomerOrFail();
        if ($this->verifyToken($customer, $customerRegistrationRequestTransfer->getAttributesOrFail()) === true) {
            $this->entityManager->flagCustomerAsVerified($customer);
            $bag->setIsVerified(true);
        }

        return $this->executePostStepPlugins($customerRegistrationRequestTransfer->setBag($bag));
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     * @param \Generated\Shared\Transfer\CustomerRegistrationAttributesTransfer $attributesTransfer
     *
     * @return bool
     */
    protected function verifyToken(CustomerTransfer $customerTransfer, CustomerRegistrationAttributesTransfer $attributesTransfer): bool
    {
        $token = $attributesTransfer->getToken();
        if ($token === null) {
            return false;
        }

        return $customerTransfer->getRegistrationKey() === $token;
    }
}
