<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business\Model;

use FondOfOryx\Shared\CompanyDeleter\CompanyDeleterConstants;
use FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutorInterface;
use FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;
use Throwable;

class CompanyDeleter implements CompanyDeleterInterface
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutorInterface
     */
    protected $pluginExecutor;

    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandler;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeInterface
     */
    protected $companyFacade;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeInterface $companyFacade
     * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
     * @param \FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutorInterface $pluginExecutor
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        CompanyDeleterToCompanyFacadeInterface $companyFacade,
        TransactionHandlerInterface $transactionHandler,
        PluginExecutorInterface $pluginExecutor,
        LoggerInterface $logger
    ) {
        $this->companyFacade = $companyFacade;
        $this->transactionHandler = $transactionHandler;
        $this->pluginExecutor = $pluginExecutor;
        $this->logger = $logger;
    }

    /**
     * @param array $idCompanies
     *
     * @return array<string, array<int>>
     */
    public function delete(array $idCompanies): array
    {
        $self = $this;
        $result = [];
        foreach ($idCompanies as $idCompany) {
            $companyTransfer = (new CompanyTransfer())->setIdCompany($idCompany);
            try {
                $this->transactionHandler->handleTransaction(
                    static function () use ($companyTransfer, $self) {
                        $self->pluginExecutor->executePreDeletePlugins($companyTransfer);
                        $self->companyFacade->delete($companyTransfer);
                        $self->pluginExecutor->executePostDeletePlugins($companyTransfer);
                    },
                );
                $result[CompanyDeleterConstants::SUCCESS_IDS][] = $idCompany;
            } catch (Throwable $throwable) {
                $this->logger->error($throwable->getMessage(), $throwable->getTrace());
                $result[CompanyDeleterConstants::ERROR_IDS][] = $idCompany;
            }
        }

        return $result;
    }
}
