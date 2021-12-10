<?php

namespace FondOfOryx\Zed\CustomerProductListConnector\Business;

use FondOfOryx\Zed\CustomerProductListConnector\Business\Persister\CustomerProductListRelationPersister;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Persister\CustomerProductListRelationPersisterInterface;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReader;
use FondOfOryx\Zed\CustomerProductListConnector\Business\Reader\ProductListReaderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CustomerProductListConnector\Persistence\CustomerProductListConnectorRepositoryInterface getRepository()
 */
class CustomerProductListConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CustomerProductListConnector\Business\Persister\CustomerProductListRelationPersisterInterface
     */
    public function createCustomerProductListRelationPersister(): CustomerProductListRelationPersisterInterface
    {
        return new CustomerProductListRelationPersister(
            $this->createProductListReader(),
            $this->getEntityManager(),
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
}
