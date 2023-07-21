<?php

namespace FondOfOryx\Zed\CompanyTypeConverter\Business\Model;

use FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyReader implements CompanyReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyFacadeInterface
     */
    protected $companyFacade;

    /**
     * @param \FondOfOryx\Zed\CompanyTypeConverter\Dependency\Facade\CompanyTypeConverterToCompanyFacadeInterface $companyFacade
     */
    public function __construct(CompanyTypeConverterToCompanyFacadeInterface $companyFacade)
    {
        $this->companyFacade = $companyFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function findCompanyById(CompanyTransfer $companyTransfer): CompanyTransfer
    {
        return $this->companyFacade->getCompanyById($companyTransfer);
    }
}
