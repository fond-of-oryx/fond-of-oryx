<?php

namespace FondOfOryx\Zed\CompanyProductListConnector\Business;

use FondOfOryx\Zed\CompanyProductListConnector\Business\Persister\CompanyProductListRelationPersister;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Persister\CompanyProductListRelationPersisterInterface;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReader;
use FondOfOryx\Zed\CompanyProductListConnector\Business\Reader\ProductListReaderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorEntityManagerInterface getEntityManager()
 * @method \FondOfOryx\Zed\CompanyProductListConnector\Persistence\CompanyProductListConnectorRepositoryInterface getRepository()
 */
class CompanyProductListConnectorBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyProductListConnector\Business\Persister\CompanyProductListRelationPersisterInterface
     */
    public function createCompanyProductListRelationPersister(): CompanyProductListRelationPersisterInterface
    {
        return new CompanyProductListRelationPersister(
            $this->createProductListReader(),
            $this->getEntityManager(),
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
}
