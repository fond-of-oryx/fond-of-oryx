<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business;

use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\AssignableCustomerIdsFilter;
use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface;
use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\DeassignableCustomerIdsFilter;
use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Persister\CustomerProductListRelationPersister;
use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Persister\CustomerProductListRelationPersisterInterface;
use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader\CustomerReader;
use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader\CustomerReaderInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CustomerProductListsRestApi\Persistence\CustomerProductListsRestApiEntityManagerInterface getEntityManager()
 */
class CustomerProductListsRestApiBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Persister\CustomerProductListRelationPersisterInterface
     */
    public function createCustomerProductListRelationPersister(): CustomerProductListRelationPersisterInterface
    {
        return new CustomerProductListRelationPersister(
            $this->createCustomerReader(),
            $this->createDeassignableCustomerIdsFilter(),
            $this->createAssignableCustomerIdsFilter(),
            $this->getEntityManager(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Reader\CustomerReaderInterface
     */
    protected function createCustomerReader(): CustomerReaderInterface
    {
        return new CustomerReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface
     */
    protected function createAssignableCustomerIdsFilter(): CustomerIdsFilterInterface
    {
        return new AssignableCustomerIdsFilter($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Filter\CustomerIdsFilterInterface
     */
    protected function createDeassignableCustomerIdsFilter(): CustomerIdsFilterInterface
    {
        return new DeassignableCustomerIdsFilter($this->getRepository());
    }
}
