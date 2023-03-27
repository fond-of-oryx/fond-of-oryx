<?php

namespace FondOfOryx\Zed\CompaniesRestApi\Business\Deleter;

use FondOfOryx\Shared\CompanyDeleter\CompanyDeleterConstants;
use FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface;
use FondOfOryx\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface;
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
     * @var \FondOfOryx\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\CompaniesRestApi\Dependency\Facade\CompaniesRestApiToCompanyDeleterFacadeInterface $companyDeleterFacade
     * @param \FondOfOryx\Zed\CompaniesRestApi\Persistence\CompaniesRestApiRepositoryInterface $repository
     */
    public function __construct(
        CompaniesRestApiToCompanyDeleterFacadeInterface $companyDeleterFacade,
        CompaniesRestApiRepositoryInterface $repository
    ) {
        $this->companyDeleterFacade = $companyDeleterFacade;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyTransfer
     */
    public function deleteCompany(CompanyTransfer $companyTransfer): CompanyTransfer
    {
        $arrayData = $this->companyDeleterFacade->deleteCompany($this->repository->getIdCompanyByUuid($companyTransfer->getUuid()));
        if (array_key_exists(CompanyDeleterConstants::SUCCESS_IDS, $arrayData) && $arrayData[CompanyDeleterConstants::SUCCESS_IDS][0] === $companyTransfer->getIdCompany()) {
            $companyTransfer->setStatus(static::DELETED_STATE);
        }

        return $companyTransfer->setStatus(static::ERROR_STATE);
    }
}
