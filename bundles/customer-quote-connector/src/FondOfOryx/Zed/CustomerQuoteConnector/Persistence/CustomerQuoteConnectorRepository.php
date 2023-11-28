<?php

namespace FondOfOryx\Zed\CustomerQuoteConnector\Persistence;

use Orm\Zed\Customer\Persistence\Map\SpyCustomerTableMap;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\CustomerQuoteConnector\Persistence\CustomerQuoteConnectorPersistenceFactory getFactory()
 */
class CustomerQuoteConnectorRepository extends AbstractRepository implements CustomerQuoteConnectorRepositoryInterface
{
    /**
     * @param string $customerReference
     *
     * @return int|null
     */
    public function getIdCustomerByCustomerReference(string $customerReference): ?int
    {
        /** @var int|null $idCustomer */
        $idCustomer = $this->getFactory()->getCustomerQuery()
            ->filterByCustomerReference($customerReference)
            ->select(SpyCustomerTableMap::COL_ID_CUSTOMER)
            ->findOne();

        return $idCustomer;
    }
}
