<?php

namespace FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface;

class CustomerRegistrationToCustomerQueryContainerBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerRegistration\Dependency\QueryContainer\CustomerRegistrationToCustomerQueryContainerInterface
     */
    protected $queryContainer;

    /**
     * @var \Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerQueryContainerMock;

    /**
     * @var \Orm\Zed\Customer\Persistence\SpyCustomerQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCustomerQueryMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerQueryContainerMock = $this->getMockBuilder(CustomerQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCustomerQueryMock = $this->getMockBuilder(SpyCustomerQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->queryContainer = new CustomerRegistrationToCustomerQueryContainerBridge(
            $this->customerQueryContainerMock,
        );
    }

    /**
     * @return void
     */
    public function testQueryCustomerById(): void
    {
        $this->customerQueryContainerMock->expects(static::atLeastOnce())->method('queryCustomerById')->willReturn($this->spyCustomerQueryMock);

        $this->queryContainer->queryCustomerById(1);
    }

    /**
     * @return void
     */
    public function testQueryCustomerByEmail(): void
    {
        $this->customerQueryContainerMock->expects(static::atLeastOnce())->method('queryCustomerByEmail')->willReturn($this->spyCustomerQueryMock);

        $this->queryContainer->queryCustomerByEmail('foo@bar.de');
    }

    /**
     * @return void
     */
    public function testQueryCustomers(): void
    {
        $this->customerQueryContainerMock->expects(static::atLeastOnce())->method('queryCustomers')->willReturn($this->spyCustomerQueryMock);

        $this->queryContainer->queryCustomers();
    }
}
