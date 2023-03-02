<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer;

use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface;

class CustomerRegistrationToCustomerQueryContainerBridge implements CustomerRegistrationToCustomerQueryContainerInterface
{
    /**
     * @var \Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @param \Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface $customerQueryContainer
     */
    public function __construct(CustomerQueryContainerInterface $customerQueryContainer)
    {
        $this->queryContainer = $customerQueryContainer;
    }

    /**
     * @param int $idCustomer
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomerById(int $idCustomer): SpyCustomerQuery
    {
        return $this->queryContainer->queryCustomerById($idCustomer);
    }

    /**
     * @param string $email
     *
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomerByEmail(string $email): SpyCustomerQuery
    {
        return $this->queryContainer->queryCustomerByEmail($email);
    }

    /**
     * @return \Orm\Zed\Customer\Persistence\SpyCustomerQuery
     */
    public function queryCustomers(): SpyCustomerQuery
    {
        return $this->queryContainer->queryCustomers();
    }
}
