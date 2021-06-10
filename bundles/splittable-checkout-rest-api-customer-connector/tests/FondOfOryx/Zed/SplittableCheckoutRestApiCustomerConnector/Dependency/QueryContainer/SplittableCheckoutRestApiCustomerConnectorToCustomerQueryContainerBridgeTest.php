<?php

namespace FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface;

class SplittableCheckoutRestApiCustomerConnectorToCustomerQueryContainerBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface
     */
    protected $customerQueryContainerMock;

    /**
     * @var \Orm\Zed\Customer\Persistence\SpyCustomerQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCustomerQueryMock;

    /**
     * @var \FondOfOryx\Zed\SplittableCheckoutRestApiCustomerConnector\Dependency\QueryContainer\SplittableCheckoutRestApiCustomerConnectorToCustomerQueryContainerBridge
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerQueryContainerMock = $this->getMockBuilder(CustomerQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCustomerQueryMock = $this->getMockBuilder(SpyCustomerQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new SplittableCheckoutRestApiCustomerConnectorToCustomerQueryContainerBridge(
            $this->customerQueryContainerMock
        );
    }

    /**
     * @return void
     */
    public function testQueryCustomerByReference(): void
    {
        $customerReference = 'FOO-1';

        $this->customerQueryContainerMock->expects(static::atLeastOnce())
            ->method('queryCustomerByReference')
            ->with($customerReference)
            ->willReturn($this->spyCustomerQueryMock);

        static::assertEquals(
            $this->spyCustomerQueryMock,
            $this->bridge->queryCustomerByReference($customerReference)
        );
    }
}
