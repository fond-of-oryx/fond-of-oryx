<?php

namespace FondOfOryx\Zed\CustomerStatistic\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerStatistic\Business\Model\CustomerExpander;
use FondOfOryx\Zed\CustomerStatistic\Business\Model\LoginCountIncrementer;
use FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticEntityManager;
use FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepository;

class CustomerStatisticBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticRepository|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $repositoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Persistence\CustomerStatisticEntityManager|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $entityManagerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerStatistic\Business\CustomerStatisticBusinessFactory
     */
    protected $customerStatisticBusinessFactory;

    /**
     * @Override
     *
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->repositoryMock = $this->getMockBuilder(CustomerStatisticRepository::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->entityManagerMock = $this->getMockBuilder(CustomerStatisticEntityManager::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerStatisticBusinessFactory = new CustomerStatisticBusinessFactory();
        $this->customerStatisticBusinessFactory->setEntityManager($this->entityManagerMock);
        $this->customerStatisticBusinessFactory->setRepository($this->repositoryMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerExpander(): void
    {
        static::assertInstanceOf(
            CustomerExpander::class,
            $this->customerStatisticBusinessFactory->createCustomerExpander(),
        );
    }

    /**
     * @return void
     */
    public function testCreateLoginCountIncrementer(): void
    {
        static::assertInstanceOf(
            LoginCountIncrementer::class,
            $this->customerStatisticBusinessFactory->createLoginCountIncrementer(),
        );
    }
}
