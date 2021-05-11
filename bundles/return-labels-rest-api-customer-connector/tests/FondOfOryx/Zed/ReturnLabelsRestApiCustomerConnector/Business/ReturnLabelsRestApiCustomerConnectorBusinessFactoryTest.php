<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade\ReturnLabelsRestApiCustomerConnectorToCustomerFacadeBridge;
use Spryker\Zed\Kernel\Container;

class ReturnLabelsRestApiCustomerConnectorBusinessFactoryTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\ReturnLabelsRestApiCustomerConnectorBusinessFactory
     */
    protected $factory;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade\ReturnLabelsRestApiCustomerConnectorToCustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerFacadeMock;

    /**
     * @var \Spryker\Zed\Kernel\Container|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $containerMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerFacadeMock = $this->getMockBuilder(ReturnLabelsRestApiCustomerConnectorToCustomerFacadeBridge::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factory = new ReturnLabelsRestApiCustomerConnectorBusinessFactory();
        $this->factory->setContainer($this->containerMock);
    }

    /**
     * @return void
     */
    public function testCreateCustomerExpander(): void
    {
        /*$this->containerMock->expects(static::atLeastOnce())
            ->method('get')
            ->with([ReturnLabelsRestApiCustomerConnectorDependencyProvider::FACADE_CUSTOMER])
            ->willReturnOnConsecutiveCalls($this->customerFacadeMock);

        static::assertEquals(
            CustomerExpander::class,
            $this->factory->createCustomerExpander()
        );*/
    }
}
