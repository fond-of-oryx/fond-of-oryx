<?php

namespace FondOfOryx\Zed\OneTimePasswordRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\OneTimePasswordRestApi\Business\Sender\OneTimePasswordRestApiSenderInterface;
use FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToCustomerFacadeInterface;
use FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToOneTimePasswordFacadeInterface;
use Spryker\Zed\Kernel\Container;

class OneTimePasswordRestApiBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Business\OneTimePasswordRestApiBusinessFactory
     */
    protected $oneTimePasswordRestApiBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToOneTimePasswordFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $oneTimePasswordFacadeMock;

    /**
     * @var \FondOfOryx\Zed\OneTimePasswordRestApi\Dependency\Facade\OneTimePasswordRestApiToCustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $customerFacadeMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordFacadeMock = $this->getMockBuilder(OneTimePasswordRestApiToOneTimePasswordFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerFacadeMock = $this->getMockBuilder(OneTimePasswordRestApiToCustomerFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->oneTimePasswordRestApiBusinessFactory = new OneTimePasswordRestApiBusinessFactory();
        $this->oneTimePasswordRestApiBusinessFactory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateOneTimePasswordRestApiSender(): void
    {
        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->willReturnOnConsecutiveCalls(
                $this->oneTimePasswordFacadeMock,
                $this->customerFacadeMock,
            );

        $this->assertInstanceOf(
            OneTimePasswordRestApiSenderInterface::class,
            $this->oneTimePasswordRestApiBusinessFactory->createOneTimePasswordRestApiSender(),
        );
    }
}
