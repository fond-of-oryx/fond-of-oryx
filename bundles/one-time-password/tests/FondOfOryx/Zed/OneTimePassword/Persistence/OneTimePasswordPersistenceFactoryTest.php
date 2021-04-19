<?php

namespace FondOfOryx\Zed\OneTimePassword\Persistence;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePassword\Dependency\QueryContainer\OneTimePasswordToCustomerQueryContainerInterface;
use FondOfOryx\Zed\OneTimePassword\OneTimePasswordDependencyProvider;
use Spryker\Zed\Kernel\Container;

class OneTimePasswordPersistenceFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Persistence\OneTimePasswordPersistenceFactory
     */
    protected $oneTimePasswordPersistenceFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePassword\Dependency\QueryContainer\OneTimePasswordToCustomerQueryContainerInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerQueryContainerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerQueryContainerMock = $this->getMockBuilder(OneTimePasswordToCustomerQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordPersistenceFactory = new OneTimePasswordPersistenceFactory();
        $this->oneTimePasswordPersistenceFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testGetCustomerQueryContainer(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->with(OneTimePasswordDependencyProvider::QUERY_CONTAINER_CUSTOMER)
            ->willReturn($this->customerQueryContainerMock);

        $this->assertSame(
            $this->customerQueryContainerMock,
            $this->oneTimePasswordPersistenceFactory->getCustomerQueryContainer()
        );
    }
}
