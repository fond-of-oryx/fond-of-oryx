<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business\Model;

use FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutorInterface;
use FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;

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
     * @param \FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeInterface $companyFacade
     * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
     * @param \FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutorInterface $pluginExecutor
     */
    public function __construct(
        CompanyDeleterToCompanyFacadeInterface $companyFacade,
        TransactionHandlerInterface $transactionHandler,
        PluginExecutorInterface $pluginExecutor
    ) {
        $this->companyFacade = $companyFacade;
        $this->transactionHandler = $transactionHandler;
        $this->pluginExecutor = $pluginExecutor;
    }

    /**
     * @param array $idCompanies
     *
     * @return void
     */
    public function delete(array $idCompanies): void
    {
        $self = $this;

        foreach ($idCompanies as $idCompany) {
            $companyTransfer = (new CompanyTransfer())->setIdCompany($idCompany);
            $this->transactionHandler->handleTransaction(
                static function () use ($companyTransfer, $self) {
                    $self->pluginExecutor->executePreDeletePlugins($companyTransfer);
                    $self->companyFacade->delete($companyTransfer);
                    $self->pluginExecutor->executePostDeletePlugins($companyTransfer);
                },
            );
        }
    }
}
