<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business\Executor;

use Generated\Shared\Transfer\CompanyTransfer;

class PluginExecutor implements PluginExecutorInterface
{
    /**
     * @var \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface
     */
    protected $transactionHandler;

    /**
     * @var array<\FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPreDeletePluginInterface>
     */
    protected $prePlugins;

    /**
     * @var array<\FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPostDeletePluginInterface>
     */
    protected $postPlugins;

    /**
     * @param array<\FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPreDeletePluginInterface> $prePlugins
     * @param array<\FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPostDeletePluginInterface> $postPlugins
     */
    public function __construct(array $prePlugins, array $postPlugins)
    {
        $this->prePlugins = $prePlugins;
        $this->postPlugins = $postPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function executePreDeletePlugins(CompanyTransfer $companyTransfer): void
    {
        foreach ($this->prePlugins as $plugin) {
            $plugin->execute($companyTransfer);
        }
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyTransfer $companyTransfer
     *
     * @return void
     */
    public function executePostDeletePlugins(CompanyTransfer $companyTransfer): void
    {
        foreach ($this->prePlugins as $plugin) {
            $plugin->execute($companyTransfer);
        }
    }
}
