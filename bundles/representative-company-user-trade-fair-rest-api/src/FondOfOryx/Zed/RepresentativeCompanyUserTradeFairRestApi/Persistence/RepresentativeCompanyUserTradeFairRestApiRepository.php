<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence;

use Exception;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Persistence\RepresentativeCompanyUserTradeFairRestApiPersistenceFactory getFactory()
 */
class RepresentativeCompanyUserTradeFairRestApiRepository extends AbstractRepository implements RepresentativeCompanyUserTradeFairRestApiRepositoryInterface
{
    /**
     * @param string $customerReference
     *
     * @throws \Exception
     *
     * @return int
     */
    public function getIdCustomerByReference(string $customerReference): int
    {
        $customer = $this->getFactory()->getCustomerQuery()->filterByCustomerReference($customerReference)->findOne();
        if ($customer === null) {
            throw new Exception(sprintf('Could not find customer by reference %s', $customerReference));
        }

        return $customer->getIdCustomer();
    }
}
