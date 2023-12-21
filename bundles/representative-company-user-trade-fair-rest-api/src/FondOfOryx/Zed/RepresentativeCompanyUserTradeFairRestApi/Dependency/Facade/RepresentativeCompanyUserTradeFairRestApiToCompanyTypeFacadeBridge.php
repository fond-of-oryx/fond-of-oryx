<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade;

use FondOfImpala\Zed\CompanyType\Business\CompanyTypeFacadeInterface;
use Generated\Shared\Transfer\CompanyTypeTransfer;

class RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeBridge implements RepresentativeCompanyUserTradeFairRestApiToCompanyTypeFacadeInterface
{
    /**
     * @var \FondOfImpala\Zed\CompanyType\Business\CompanyTypeFacadeInterface
     */
    protected $facade;

    /**
     * @param \FondOfImpala\Zed\CompanyType\Business\CompanyTypeFacadeInterface $companyTypeFacade
     */
    public function __construct(CompanyTypeFacadeInterface $companyTypeFacade)
    {
        $this->facade = $companyTypeFacade;
    }

    /**
     * @return \Generated\Shared\Transfer\CompanyTypeTransfer|null
     */
    public function getCompanyTypeManufacturer(): ?CompanyTypeTransfer
    {
        return $this->facade->getCompanyTypeManufacturer();
    }
}
