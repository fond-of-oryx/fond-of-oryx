<?php

namespace FondOfOryx\Zed\CustomerRegistration\Business\Mapper;

use FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface;
use Generated\Shared\Transfer\CustomerTransfer;
use Generated\Shared\Transfer\MailTransfer;

class CustomerTransferToMailTransferMapper implements CustomerTransferToMailTransferMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface
     */
    private CustomerRegistrationToLocaleFacadeInterface $localeFacade;

    /**
     * @param \FondOfOryx\Zed\CustomerRegistration\Dependency\Facade\CustomerRegistrationToLocaleFacadeInterface $localeFacade
     */
    public function __construct(CustomerRegistrationToLocaleFacadeInterface $localeFacade)
    {
        $this->localeFacade = $localeFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function map(CustomerTransfer $customerTransfer): MailTransfer
    {
        $localeTransfer = $this->localeFacade->getLocale($this->localeFacade->getCurrentLocaleName());

        return (new MailTransfer())
            ->setLocale($localeTransfer)
            ->setCustomer($customerTransfer);
    }
}
