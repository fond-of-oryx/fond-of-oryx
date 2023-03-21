<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business\Deleter;

use FondOfOryx\Shared\CompanyDeleter\CompanyDeleterConstants;
use FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;

class CompanyDeleter implements CompanyDeleterInterface
{
    /**
     * @var string
     */
    protected const DELETED_STATE = 'deleted';

    /**
     * @var string
     */
    protected const ERROR_STATE = 'error';

    /**
     * @var \FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface
     */
    protected $companyDeleterFacade;

    /**
     * @param \FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface $companyDeleterFacade
     */
    public function __construct(
        CompaniesRestApiToCompanyDeleterFacadeInterface $companyDeleterFacade
    )
    {
        $this->companyDeleterFacade = $companyDeleterFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function deleteCompany(CompanyTransfer $companyTransfer): CompanyTransfer
    {
        $arrayData = $this->companyDeleterFacade->deleteCompany($companyTransfer->getIdCompany());
        if (array_key_exists(CompanyDeleterConstants::SUCCESS_IDS, $arrayData) && $arrayData[CompanyDeleterConstants::SUCCESS_IDS][0] === $companyTransfer->getIdCompany()) {
            $companyTransfer->setStatus(static::DELETED_STATE);
        }
        return $companyTransfer->setStatus(static::ERROR_STATE);
    }
}
