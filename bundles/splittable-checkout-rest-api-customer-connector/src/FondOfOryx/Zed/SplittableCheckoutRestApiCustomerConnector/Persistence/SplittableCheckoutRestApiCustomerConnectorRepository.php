<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Persistence;

use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Persistence\SplittableCheckoutRestApiCustomerConnectorPersistenceFactory getFactory()
 */
class SplittableCheckoutRestApiCustomerConnectorRepository extends AbstractRepository implements
    SplittableCheckoutRestApiCustomerConnectorRepositoryInterface
{
    /**
     * @param string $customerReference
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer|null
     */
    public function getCustomerByCustomerReference(string $customerReference): ?CustomerTransfer
    {
        $spyCustomerQuery = $this->getFactory()->getCustomerQueryContainer()
           ->queryCustomerByReference($customerReference);

        $spyCustomer = $spyCustomerQuery->findOne();

        if ($spyCustomer === null) {
            return null;
        }

        return (new CustomerTransfer())->fromArray($spyCustomer->toArray());
    }
}
