<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander\CompanyBusinessUnitExpander;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelsRestApiCompanyBusinessUnitConnectorFacadeTest extends Unit
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
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\ReturnLabelsRestApiCompanyBusinessUnitConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\Expander\CompanyBusinessUnitExpander|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitExpanderMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\ReturnLabelsRestApiCompanyBusinessUnitConnectorFacade
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

        $this->companyBusinessUnitExpanderMock = $this->getMockBuilder(CompanyBusinessUnitExpander::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(ReturnLabelsRestApiCompanyBusinessUnitConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new ReturnLabelsRestApiCompanyBusinessUnitConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testExpandReturnLabelRequest(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyBusinessUnitExpander')
            ->willReturn($this->companyBusinessUnitExpanderMock);

        $this->companyBusinessUnitExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restReturnLabelRequestTransferMock, $this->returnLabelRequestTransferMock)
            ->willReturn($this->returnLabelRequestTransferMock);

        static::assertEquals($this->returnLabelRequestTransferMock, $this->facade->expandReturnLabelRequest(
            $this->restReturnLabelRequestTransferMock,
            $this->returnLabelRequestTransferMock,
        ));
    }
}
