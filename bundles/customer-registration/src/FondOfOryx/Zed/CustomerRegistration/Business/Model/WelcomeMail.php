<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Model;

use FondOfOryx\Zed\CustomerRegistration\Business\Mapper\CustomerTransferToMailTransferMapperInterface;
use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface;
use FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface;

class WelcomeMail
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface
     */
    private CustomerRegistrationToMailFacadeInterface $mailFacade;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface
     */
    private CustomerRegistrationRepositoryInterface $customerRegistrationRepository;

    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Business\Mapper\CustomerTransferToMailTransferMapperInterface
     */
    private CustomerTransferToMailTransferMapperInterface $customerTransferToMailTransferMapper;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToMailFacadeInterface $mailFacade
     * @param \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationRepositoryInterface $customerRegistrationRepository
     * @param \FondOfOryx\Zed\CustomerRegistration\Business\Mapper\CustomerTransferToMailTransferMapperInterface $customerTransferToMailTransferMapper
     */
    public function __construct(
        CustomerRegistrationToMailFacadeInterface $mailFacade,
        CustomerRegistrationRepositoryInterface $customerRegistrationRepository,
        CustomerTransferToMailTransferMapperInterface $customerTransferToMailTransferMapper
    ) {
        $this->mailFacade = $mailFacade;
        $this->customerRegistrationRepository = $customerRegistrationRepository;
        $this->customerTransferToMailTransferMapper = $customerTransferToMailTransferMapper;
    }

    /**
     * @param int $idCustomer
     *
     * @return void
     */
    public function handleMail(int $idCustomer): void
    {
        $customerTransfer = $this->customerRegistrationRepository->findCustomerById($idCustomer);
        $mailTransfer = $this->customerTransferToMailTransferMapper->map($customerTransfer);

        $this->mailFacade->handleMail($mailTransfer);
    }
}
