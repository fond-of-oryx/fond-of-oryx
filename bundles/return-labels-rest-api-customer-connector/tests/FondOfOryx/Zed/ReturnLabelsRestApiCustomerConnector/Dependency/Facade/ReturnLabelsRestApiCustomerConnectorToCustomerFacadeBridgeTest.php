<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\CustomerTransfer;
use Spryker\Zed\Customer\Business\CustomerFacade;

class ReturnLabelsRestApiCustomerConnectorToCustomerFacadeBridgeTest extends Unit
{
    /**
     * @var \Spryker\Zed\Customer\Business\CustomerFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Dependency\Facade\ReturnLabelsRestApiCustomerConnectorToCustomerFacadeInterface
     */
    protected $bridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerFacadeMock = $this->getMockBuilder(CustomerFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerTransferMock = $this->getMockBuilder(CustomerTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->bridge = new ReturnLabelsRestApiCustomerConnectorToCustomerFacadeBridge($this->customerFacadeMock);
    }

    /**
     * @return void
     */
    public function testFindCustomerById(): void
    {
        $this->customerFacadeMock->expects(static::atLeastOnce())
            ->method('findCustomerById')
            ->with($this->customerTransferMock)
            ->willReturn($this->customerTransferMock);

        static::assertEquals(
            $this->customerTransferMock,
            $this->bridge->findCustomerById($this->customerTransferMock)
        );
    }
}
