<?php

namespace FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business;

use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Expander\QueryJoinCollectionExpander;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Expander\QueryJoinCollectionExpanderInterface;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\CompanyBusinessUnitUuidFilter;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\CompanyBusinessUnitUuidFilterInterface;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\IdCustomerFilter;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\IdCustomerFilterInterface;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Reader\CompanyBusinessUnitReader;
use FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Reader\CompanyBusinessUnitReaderInterface;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Persistence\CompanyBusinessUnitCartSearchRestApiRepositoryInterface getRepository()
 */
class CompanyBusinessUnitCartSearchRestApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Expander\QueryJoinCollectionExpanderInterface
     */
    public function createQueryJoinCollectionExpander(): QueryJoinCollectionExpanderInterface
    {
        return new QueryJoinCollectionExpander(
            $this->createCompanyBusinessUnitReader(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Reader\CompanyBusinessUnitReaderInterface
     */
    protected function createCompanyBusinessUnitReader(): CompanyBusinessUnitReaderInterface
    {
        return new CompanyBusinessUnitReader(
            $this->createIdCustomerFilter(),
            $this->createCompanyBusinessUnitUuidFilter(),
            $this->getRepository(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\IdCustomerFilterInterface
     */
    protected function createIdCustomerFilter(): IdCustomerFilterInterface
    {
        return new IdCustomerFilter();
    }

    /**
     * @return \FondOfOryx\Zed\CompanyBusinessUnitCartSearchRestApi\Business\Filter\CompanyBusinessUnitUuidFilterInterface
     */
    protected function createCompanyBusinessUnitUuidFilter(): CompanyBusinessUnitUuidFilterInterface
    {
        return new CompanyBusinessUnitUuidFilter();
    }
}
