<?php

namespace FondOfOryx\Zed\OneTimePassword\Dependency\QueryContainer;

use Codeception\Test\Unit;
use Orm\Zed\Customer\Persistence\SpyCustomerQuery;
use Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface;

class OneTimePasswordToCustomerQueryContainerBridgeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\QueryContainer\OneTimePasswordToCustomerQueryContainerBridge
     */
    protected $oneTimePasswordToCustomerQueryContainerBridge;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Customer\Persistence\CustomerQueryContainerInterface
     */
    protected $customerQueryContainerMock;

    /**
     * @var \Orm\Zed\Customer\Persistence\SpyCustomerQuery|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $spyCustomerQuery;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $customerReference;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->customerQueryContainerMock = $this->getMockBuilder(CustomerQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->spyCustomerQuery = $this->getMockBuilder(SpyCustomerQuery::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->email = 'email';

        $this->customerReference = 'customer-reference';

        $this->oneTimePasswordToCustomerQueryContainerBridge = new OneTimePasswordToCustomerQueryContainerBridge(
            $this->customerQueryContainerMock,
        );
    }

    /**
     * @return void
     */
    public function testQueryCustomerByEmail(): void
    {
        $this->customerQueryContainerMock->expects($this->atLeastOnce())
            ->method('queryCustomerByEmail')
            ->with($this->email)
            ->willReturn($this->spyCustomerQuery);

        $this->assertSame(
            $this->spyCustomerQuery,
            $this->oneTimePasswordToCustomerQueryContainerBridge->queryCustomerByEmail(
                $this->email,
            ),
        );
    }

    /**
     * @return void
     */
    public function testQueryCustomerByReference(): void
    {
        $this->customerQueryContainerMock->expects($this->atLeastOnce())
            ->method('queryCustomerByReference')
            ->with($this->customerReference)
            ->willReturn($this->spyCustomerQuery);

        $this->assertSame(
            $this->spyCustomerQuery,
            $this->oneTimePasswordToCustomerQueryContainerBridge->queryCustomerByReference(
                $this->customerReference,
            ),
        );
    }
}
