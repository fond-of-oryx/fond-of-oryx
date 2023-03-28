<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade;

use Generated\Shared\Transfer\CompanyUserResponseTransfer;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\BusinessOnBehalf\Business\BusinessOnBehalfFacadeInterface;

class BusinessOnBehalfRestApiToBusinessOnBehalfFacadeBridge implements BusinessOnBehalfRestApiToBusinessOnBehalfFacadeInterface
{
    /**
     * @var \Spryker\Zed\BusinessOnBehalf\Business\BusinessOnBehalfFacadeInterface
     */
    protected BusinessOnBehalfFacadeInterface $businessOnBehalfFacade;

    /**
     * @param \Spryker\Zed\BusinessOnBehalf\Business\BusinessOnBehalfFacadeInterface $businessOnBehalfFacade
     */
    public function __construct(BusinessOnBehalfFacadeInterface $businessOnBehalfFacade)
    {
        $this->businessOnBehalfFacade = $businessOnBehalfFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserTransfer $companyUserTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserResponseTransfer
     */
    public function setDefaultCompanyUser(CompanyUserTransfer $companyUserTransfer): CompanyUserResponseTransfer
    {
        return $this->businessOnBehalfFacade->setDefaultCompanyUser($companyUserTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\CustomerTransfer $customerTransfer
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function unsetDefaultCompanyUserByCustomer(CustomerTransfer $customerTransfer): CustomerTransfer
    {
        return $this->businessOnBehalfFacade->unsetDefaultCompanyUserByCustomer($customerTransfer);
    }
}
