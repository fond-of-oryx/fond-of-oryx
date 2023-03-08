<?php

namespace FondOfOryx\Zed\CompanyDeleter\Business;

use FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutor;
use FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutorInterface;
use FondOfOryx\Zed\CompanyDeleter\Business\Model\CompanyDeleter;
use FondOfOryx\Zed\CompanyDeleter\Business\Model\CompanyDeleterInterface;
use FondOfOryx\Zed\CompanyDeleter\CompanyDeleterDependencyProvider;
use FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class CompanyDeleterBusinessFactory extends AbstractBusinessFactory
{
    use TransactionTrait;

    /**
     * @return \FondOfOryx\Zed\CompanyDeleter\Business\Model\CompanyDeleterInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createCompanyDeleter(): CompanyDeleterInterface
    {
        return new CompanyDeleter(
            $this->getCompanyFacade(),
            $this->getTransactionHandler(),
            $this->createCompanyDeleterPluginExecutor()
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyDeleter\Business\Executor\PluginExecutorInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    public function createCompanyDeleterPluginExecutor(): PluginExecutorInterface
    {
        return new PluginExecutor($this->getPreDeletePlugins(), $this->getPostDeletePlugins());
    }

    /**
     * @return \FondOfOryx\Zed\CompanyDeleter\Dependency\Facade\CompanyDeleterToCompanyFacadeInterface
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getCompanyFacade(): CompanyDeleterToCompanyFacadeInterface
    {
        return $this->getProvidedDependency(CompanyDeleterDependencyProvider::FACADE_COMPANY);
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPreDeletePluginInterface>
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getPreDeletePlugins(): array
    {
        return $this->getProvidedDependency(CompanyDeleterDependencyProvider::PLUGINS_PRE_COMPANY_DELETER);
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyDeleterExtension\Communication\Plugin\CompanyDeleterPostDeletePluginInterface>
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getPostDeletePlugins(): array
    {
        return $this->getProvidedDependency(CompanyDeleterDependencyProvider::PLUGINS_POST_COMPANY_DELETER);
    }
}