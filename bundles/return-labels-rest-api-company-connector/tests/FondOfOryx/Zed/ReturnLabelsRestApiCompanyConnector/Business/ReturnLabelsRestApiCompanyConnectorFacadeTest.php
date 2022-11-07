<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Expander\ReturnLabelRequestExpander;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelsRestApiCompanyConnectorFacadeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\Expander\ReturnLabelRequestExpander|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestExpanderMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\ReturnLabelsRestApiCompanyConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\ReturnLabelsRestApiCompanyConnectorFacadeInterface
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restReturnLabelRequestTransferMock = $this->getMockBuilder(RestReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestExpanderMock = $this->getMockBuilder(ReturnLabelRequestExpander::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(ReturnLabelsRestApiCompanyConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ReturnLabelsRestApiCompanyConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpandReturnLabelRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createReturnLabelRequestExpander')
            ->willReturn($this->returnLabelRequestExpanderMock);

        $this->returnLabelRequestExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restReturnLabelRequestTransferMock, $this->returnLabelRequestTransferMock)
            ->willReturn($this->returnLabelRequestTransferMock);

        $returnLabelRequestTransfer = $this->facade->expandReturnLabelRequest(
            $this->restReturnLabelRequestTransferMock,
            $this->returnLabelRequestTransferMock,
        );

        static::assertEquals($returnLabelRequestTransfer, $this->returnLabelRequestTransferMock);
    }
}
