<?php

namespace FondOfOryx\Zed\BusinessOnBehalfRestApi\Business\Reader;

use FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface;
use FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUserTransfer;
use Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer;

class CompanyUserReader implements CompanyUserReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface
     */
    protected BusinessOnBehalfRestApiToCompanyUserFacadeInterface $companyUserFacade;

    /**
     * @var \FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepositoryInterface
     */
    protected BusinessOnBehalfRestApiRepositoryInterface $repository;

    /**
     * @param \FondOfOryx\Zed\BusinessOnBehalfRestApi\Dependency\Facade\BusinessOnBehalfRestApiToCompanyUserFacadeInterface $companyUserFacade
     * @param \FondOfOryx\Zed\BusinessOnBehalfRestApi\Persistence\BusinessOnBehalfRestApiRepositoryInterface $repository
     */
    public function __construct(
        BusinessOnBehalfRestApiToCompanyUserFacadeInterface $companyUserFacade,
        BusinessOnBehalfRestApiRepositoryInterface $repository
    ) {
        $this->companyUserFacade = $companyUserFacade;
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserTransfer|null
     */
    public function getByRestBusinessOnBehalfRequest(
        RestBusinessOnBehalfRequestTransfer $restBusinessOnBehalfRequestTransfer
    ): ?CompanyUserTransfer {
        $idCustomer = $restBusinessOnBehalfRequestTransfer->getIdCustomer();
        $companyUserReference = $restBusinessOnBehalfRequestTransfer->getCompanyUserReference();

        if ($idCustomer === null || $companyUserReference === null) {
            return null;
        }

        $idCompanyUser = $this->repository->getIdCompanyUserByIdCustomerAndCompanyUserReference(
            $idCustomer,
            $companyUserReference,
        );

        if ($idCompanyUser === null) {
            return null;
        }

        return $this->companyUserFacade->getCompanyUserById($idCompanyUser);
    }
}
