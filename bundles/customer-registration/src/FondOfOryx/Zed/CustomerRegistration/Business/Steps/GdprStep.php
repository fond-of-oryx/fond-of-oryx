<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Steps;

use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationEntityManagerInterface;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface;
use Generated\Shared\Transfer\CustomerRegistrationRequestTransfer;

class GdprStep extends AbstractStep implements GdprStepInterface
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
    public function checkGdprState(CustomerRegistrationRequestTransfer $customerRegistrationRequestTransfer): CustomerRegistrationRequestTransfer
    {
        $bag = $this->getBag($customerRegistrationRequestTransfer);
        $bag->setGdprAccepted(false);

        if ($this->checkPreConditions($customerRegistrationRequestTransfer) === false) {
            return $customerRegistrationRequestTransfer->setBag($bag);
        }

        $attributes = $customerRegistrationRequestTransfer->getAttributesOrFail();
        if ($attributes->getAcceptGdpr() === true) {
            $customerTransfer = $bag->getCustomerOrFail();
            $updatedCustomer = $this->entityManager->flagCustomerAsGdprAccepted($customerTransfer);
            $bag
                ->setCustomer($customerTransfer->setGdprAccepted($updatedCustomer->getGdprAccepted()))
                ->setGdprAccepted(true);
        }

        return $this->executePostStepPlugins($customerRegistrationRequestTransfer->setBag($bag));
    }
}
