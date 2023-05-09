<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Manager;

use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

class CompanyUserManager implements CompanyUserManagerInterface
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface
     */
    protected $reader;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface
     */
    protected $companyUserFacade;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandler;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface $reader
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Dependency\Facade\RepresentativeCompanyUserToCompanyUserFacadeInterface $companyUserFacade
     * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
     */
    public function __construct(
        RepresentativeCompanyUserReaderInterface $reader,
        RepresentativeCompanyUserToCompanyUserFacadeInterface $companyUserFacade,
        TransactionHandlerInterface $transactionHandler
    ) {
        $this->reader = $reader;
        $this->companyUserFacade = $companyUserFacade;
        $this->transactionHandler = $transactionHandler;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return void
     */
    public function createCompanyUserForRepresentation(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): void
    {
        $this->transactionHandler->handleTransaction(
            function () use ($representativeCompanyUserTransfer) {
                $this->executeCreateTransaction($representativeCompanyUserTransfer);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return void
     */
    public function deleteCompanyUserForRepresentation(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): void
    {
        $this->transactionHandler->handleTransaction(
            function () use ($representativeCompanyUserTransfer) {
                $this->executeDeleteTransaction($representativeCompanyUserTransfer);
            },
        );
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return void
     */
    protected function executeCreateTransaction(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): void
    {
        $users = $this->resolveCompanyUserToCreate($representativeCompanyUserTransfer);
        foreach ($users as $companyUserTransfer) {
            $companyUserTransfer->setIdCompanyUser(null)
                ->setCompanyUserReference(null)
                ->setIsDefault(false)
                ->setCustomerReference($representativeCompanyUserTransfer->getRepresentative()->getCustomerReference())
                ->setFkCustomer($representativeCompanyUserTransfer->getFkRepresentative())
                ->setCustomer($representativeCompanyUserTransfer->getRepresentative())
                ->setFkRepresentativeCompanyUser($representativeCompanyUserTransfer->getIdRepresentativeCompanyUser());
            $response = $this->companyUserFacade->create($companyUserTransfer);
            if (!$response->getIsSuccessful()) {
                //ToDo handle error case
            }
        }
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return void
     */
    protected function executeDeleteTransaction(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): void
    {
        $companyUserCollection = $this->reader->getAllCompanyUserByFkRepresentativeCompanyUser($representativeCompanyUserTransfer->getIdRepresentativeCompanyUser());

        foreach ($companyUserCollection->getCompanyUsers() as $companyUser) {
            $response = $this->companyUserFacade->deleteCompanyUser($companyUser);
            if ($response->getIsSuccessful() === false) {
                //ToDo Logging
            }
        }
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return array<\Generated\Shared\Transfer\CompanyUserTransfer>
     */
    protected function resolveCompanyUserToCreate(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): array
    {
        $companyUserDistributor = $this->reader->getAllCompanyUserByCustomerId($representativeCompanyUserTransfer->getFkDistributor());
        $companyIdsRepresentation = $this->getCompanyIdsByIdCustomer($representativeCompanyUserTransfer->getFkRepresentative());

        $users = [];
        foreach ($companyUserDistributor->getCompanyUsers() as $companyUser) {
            if (in_array($companyUser->getFkCompany(), $companyIdsRepresentation)) {
                continue;
            }

            $users[] = $companyUser;
        }

        return $users;
    }

    /**
     * @param int $idCustomer
     *
     * @return array<int>
     */
    protected function getCompanyIdsByIdCustomer(int $idCustomer): array
    {
        $companyUserCollection = $this->reader->getAllCompanyUserByCustomerId($idCustomer);
        $companyIds = [];
        foreach ($companyUserCollection->getCompanyUsers() as $companyUser) {
            $companyIds[] = $companyUser->getFkCompany();
        }

        return $companyIds;
    }
}
