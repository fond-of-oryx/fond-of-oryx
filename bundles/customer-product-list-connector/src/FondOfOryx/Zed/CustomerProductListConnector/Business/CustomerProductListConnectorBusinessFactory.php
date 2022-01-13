<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business;

use FondOfOryx\Zed\CustomerProductListConnector\Business\Persister\CustomerProductListRelationPersister;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Persister\CustomerProductListRelationPersisterInterface;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReader;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface;
use FondOfOryx\Zed\CustomerProductListConnector\CustomerProductListConnectorDependencyProvider;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorRepositoryInterface getRepository()
 */
class CustomerProductListConnectorBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\CustomerProductListConnector\Business\Persister\CustomerProductListRelationPersisterInterface
     */
    public function createCustomerProductListRelationPersister(): CustomerProductListRelationPersisterInterface
    {
        return new CustomerProductListRelationPersister(
            $this->createProductListReader(),
            $this->getEntityManager(),
            $this->getLogger(),
            $this->getCustomerProductListRelationPostPersistPlugins(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface
     */
    public function createProductListReader(): ProductListReaderInterface
    {
        return new ProductListReader(
            $this->getRepository(),
        );
    }

    /**
     * @return array<\FondOfOryx\Zed\CustomerProductListConnectorExtension\Dependency\Plugin\CustomerProductListRelationPostPersistPluginInterface>
     */
    protected function getCustomerProductListRelationPostPersistPlugins(): array
    {
        return $this->getProvidedDependency(
            CustomerProductListConnectorDependencyProvider::PLUGINS_CUSTOMER_PRODUCT_LIST_RELATION_POST_PERSIST,
        );
    }
}
