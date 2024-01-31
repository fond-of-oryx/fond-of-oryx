<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence;

use Exception;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUserRestApi\Persistence\RepresentativeCompanyUserRestApiPersistenceFactory getFactory()
 */
class RepresentativeCompanyUserRestApiRepository extends AbstractRepository implements RepresentativeCompanyUserRestApiRepositoryInterface
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
    /**
     * @param string $mail
     *
     * @throws \Exception
     *
     * @return string
     */
    public function getCustomerReferenceByMail(string $mail): string
    {
        $customer = $this->getFactory()->getCustomerQuery()->filterByEmail($mail)->findOne();
        if ($customer === null) {
            throw new Exception(sprintf('Could not find customer by mail %s', $mail));
        }

        return $customer->getCustomerReference();
    }
}
