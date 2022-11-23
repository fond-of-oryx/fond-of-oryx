<?php

namespace FondOfOryx\Zed\CompanyProductListsRestApi\Business;

use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\AssignableCompanyIdsFilter;
use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface;
use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\DeassignableCompanyIdsFilter;
use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Persister\CompanyProductListRelationPersister;
use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Persister\CompanyProductListRelationPersisterInterface;
use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader\CompanyReader;
use FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader\CompanyReaderInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\CompanyProductListsRestApi\Persistence\CompanyProductListsRestApiEntityManagerInterface getEntityManager()
 */
class CompanyProductListsRestApiBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Persister\CompanyProductListRelationPersisterInterface
     */
    public function createCompanyProductListRelationPersister(): CompanyProductListRelationPersisterInterface
    {
        return new CompanyProductListRelationPersister(
            $this->createDeassignableCompanyIdsFilter(),
            $this->createAssignableCompanyIdsFilter(),
            $this->createCompanyReader(),
            $this->getEntityManager(),
            $this->getLogger(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Reader\CompanyReaderInterface
     */
    protected function createCompanyReader(): CompanyReaderInterface
    {
        return new CompanyReader($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface
     */
    protected function createAssignableCompanyIdsFilter(): CompanyIdsFilterInterface
    {
        return new AssignableCompanyIdsFilter($this->getRepository());
    }

    /**
     * @return \FondOfOryx\Zed\CompanyProductListsRestApi\Business\Filter\CompanyIdsFilterInterface
     */
    protected function createDeassignableCompanyIdsFilter(): CompanyIdsFilterInterface
    {
        return new DeassignableCompanyIdsFilter($this->getRepository());
    }
}
