<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business;

use FondOfOryx\Zed\CompanyProductListConnector\Business\Persister\CompanyProductListRelationPersister;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Persister\CompanyProductListRelationPersisterInterface;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReader;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\CompanyProductListConnector\CompanyProductListConnectorDependencyProvider;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorRepositoryInterface getRepository()
 */
class CompanyProductListConnectorBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\CompanyProductListConnector\Business\Persister\CompanyProductListRelationPersisterInterface
     */
    public function createCompanyProductListRelationPersister(): CompanyProductListRelationPersisterInterface
    {
        return new CompanyProductListRelationPersister(
            $this->createProductListReader(),
            $this->getEntityManager(),
            $this->getLogger(),
            $this->getCompanyProductListRelationPostPersistPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface
     */
    public function createProductListReader(): ProductListReaderInterface
    {
        return new ProductListReader(
            $this->getRepository(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\CompanyProductListConnectorExtension\Dependency\Plugin\CompanyProductListRelationPostPersistPluginInterface>
     */
    protected function getCompanyProductListRelationPostPersistPlugins(): array
    {
        return $this->getProvidedDependency(
            CompanyProductListConnectorDependencyProvider::PLUGINS_COMPANY_PRODUCT_LIST_RELATION_POST_PERSIST,
        );
    }
}
