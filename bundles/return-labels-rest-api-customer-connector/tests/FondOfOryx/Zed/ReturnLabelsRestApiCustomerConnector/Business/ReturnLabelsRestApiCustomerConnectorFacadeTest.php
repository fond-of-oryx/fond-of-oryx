<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpander;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelsRestApiCustomerConnectorFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\ReturnLabelsRestApiCustomerConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelsRestApiCustomerConnectorBusinessFactory;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander\CustomerExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerExpanderMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\ReturnLabelsRestApiCustomerConnectorFacadeInterface
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->returnLabelsRestApiCustomerConnectorBusinessFactory = $this->getMockBuilder(ReturnLabelsRestApiCustomerConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerExpanderMock = $this->getMockBuilder(CustomerExpander::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ReturnLabelsRestApiCustomerConnectorFacade();
        $this->facade->setFactory($this->returnLabelsRestApiCustomerConnectorBusinessFactory);
    }

    /**
     * @return void
     */
    public function testExpandReturnLabelRequest(): void
    {
        $this->returnLabelsRestApiCustomerConnectorBusinessFactory->expects(static::atLeastOnce())
            ->method('createCustomerExpander')
            ->willReturn($this->customerExpanderMock);

        $this->customerExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restReturnLabelRequestTransferMock, $this->returnLabelRequestTransferMock)
            ->willReturn($this->returnLabelRequestTransferMock);

        static::assertEquals(
            $this->returnLabelRequestTransferMock,
            $this->facade->expandReturnLabelRequest(
                $this->restReturnLabelRequestTransferMock,
                $this->returnLabelRequestTransferMock,
            ),
        );
    }
}
