<?php

namespace FondOfOryx\Zed\CustomerRegistration\Persistence;

use Exception;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Kernel\Persistence\AbstractRepository;

/**
 * @method \FondOfOryx\Zed\CustomerRegistration\Persistence\CustomerRegistrationPersistenceFactory getFactory()
 */
class CustomerRegistrationRepository extends AbstractRepository implements CustomerRegistrationRepositoryInterface
{
    /**
     * @param string $token
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function findCustomerByToken(string $token): CustomerTransfer
    {
        $spyCustomer = $this->getFactory()->getCustomerQueryContainer()->queryCustomers()->findOneByRegistrationKey($token);

        if ($spyCustomer === null) {
            throw new Exception(sprintf('Could not find customer by token "%s"', $token));
        }

        return (new CustomerTransfer())->fromArray($spyCustomer->toArray(), true);
    }

    /**
     * @param int $idCustomer
     *
     * @throws \Exception
     *
     * @return \Generated\Shared\Transfer\CustomerTransfer
     */
    public function findCustomerById(int $idCustomer): CustomerTransfer
    {
        $spyCustomer = $this->getFactory()
            ->getCustomerQueryContainer()
            ->queryCustomerById($idCustomer)
            ->findOne();

        if ($spyCustomer === null) {
            throw new Exception(sprintf('Could not find customer by id "%s"', $idCustomer));
        }

        return (new CustomerTransfer())->fromArray($spyCustomer->toArray(), true);
    }
}
