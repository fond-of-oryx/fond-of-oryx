<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business\Deleter;

use FondOfOryx\Shared\CompanyDeleter\CompanyDeleterConstants;
use FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface;
use Generated\Shared\Transfer\CompanyCollectionTransfer;

class CompanyDeleter implements CompanyDeleterInterface
{
    protected const DELETED_STATE = 'deleted';

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
    ) {
        $this->companyDeleterFacade = $companyDeleterFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyCollectionTransfer $companyCollectionTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyCollectionTransfer
     */
    public function deleteCompanies(CompanyCollectionTransfer $companyCollectionTransfer): CompanyCollectionTransfer
    {
        foreach ($companyCollectionTransfer->getCompanies() as $companyTransfer){
            $arrayData = $this->companyDeleterFacade->deleteCompany($companyTransfer->getIdCompany());
            if (array_key_exists(CompanyDeleterConstants::SUCCESS_IDS, $arrayData) && $arrayData[CompanyDeleterConstants::SUCCESS_IDS][0] === $companyTransfer->getIdCompany()){
                $companyTransfer->setStatus(static::DELETED_STATE);
                continue;
            }
            $companyTransfer->setStatus(static::ERROR_STATE);
        }

        return $companyCollectionTransfer;
    }
}
