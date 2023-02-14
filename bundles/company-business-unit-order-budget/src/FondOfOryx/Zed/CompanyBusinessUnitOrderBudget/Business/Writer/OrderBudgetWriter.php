<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Writer;

use Exception;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reader\OrderBudgetReaderInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface;
use FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class OrderBudgetWriter implements OrderBudgetWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reader\OrderBudgetReaderInterface
     */
    protected $orderBudgetReader;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface
     */
    protected $orderBudgetFacade;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface
     */
    protected $repository;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Business\Reader\OrderBudgetReaderInterface $orderBudgetReader
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Dependency\Facade\CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface $orderBudgetFacade
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\CompanyBusinessUnitOrderBudget\Persistence\CompanyBusinessUnitOrderBudgetRepositoryInterface $repository
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        OrderBudgetReaderInterface $orderBudgetReader,
        CompanyBusinessUnitOrderBudgetToOrderBudgetFacadeInterface $orderBudgetFacade,
        CompanyBusinessUnitOrderBudgetEntityManagerInterface $entityManager,
        CompanyBusinessUnitOrderBudgetRepositoryInterface $repository,
        LoggerInterface $logger
    ) {
        $this->orderBudgetReader = $orderBudgetReader;
        $this->orderBudgetFacade = $orderBudgetFacade;
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->logger = $logger;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return void
     */
    public function createForCompanyBusinessUnit(CompanyBusinessUnitTransfer $companyBusinessUnitTransfer): void
    {
        $self = $this;

        try {
            $this->getTransactionHandler()
                ->handleTransaction(static function () use ($self, $companyBusinessUnitTransfer) {
                        $self->doCreateForCompanyBusinessUnit($companyBusinessUnitTransfer);
                });
        } catch (Exception $exception) {
            $this->logger->error('Could not create order budget for given company business unit.', [
                'exception' => $exception->getMessage(),
                'trace' => $exception->getTraceAsString(),
                'data' => $companyBusinessUnitTransfer->serialize(),
            ]);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyBusinessUnitTransfer $companyBusinessUnitTransfer
     *
     * @return void
     */
    protected function doCreateForCompanyBusinessUnit(CompanyBusinessUnitTransfer $companyBusinessUnitTransfer): void
    {
        $idOrderBudget = $companyBusinessUnitTransfer->getFkOrderBudget();

        if ($idOrderBudget !== null) {
            return;
        }

        $idOrderBudget = $this->orderBudgetReader->getIdOrderBudgetByCompanyBusinessUnit(
            $companyBusinessUnitTransfer,
        );

        if ($idOrderBudget !== null) {
            return;
        }

        $orderBudgetTransfer = $this->orderBudgetFacade->createOrderBudget();

        $companyBusinessUnitTransfer->setFkOrderBudget($orderBudgetTransfer->getIdOrderBudget())
            ->setOrderBudget($orderBudgetTransfer);

        $this->entityManager->assignOrderBudgetToCompanyBusinessUnit($companyBusinessUnitTransfer);
    }

    /**
     * @return void
     */
    public function createMissing(): void
    {
        $companyBusinessUnitIds = $this->repository->getCompanyBusinessUnitIdsWithoutOrderBudget();

        foreach ($companyBusinessUnitIds as $idCompanyBusinessUnitId) {
            $companyBusinessUnitTransfer = (new CompanyBusinessUnitTransfer())
                ->setIdCompanyBusinessUnit($idCompanyBusinessUnitId);

            $this->createForCompanyBusinessUnit($companyBusinessUnitTransfer);
        }
    }
}
