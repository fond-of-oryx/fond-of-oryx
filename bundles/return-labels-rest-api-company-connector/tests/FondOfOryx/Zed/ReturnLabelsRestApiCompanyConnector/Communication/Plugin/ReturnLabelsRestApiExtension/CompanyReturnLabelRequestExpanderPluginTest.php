<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Communication\Plugin\ReturnLabelsRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\ReturnLabelsRestApiCompanyConnectorFacade;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class CompanyReturnLabelRequestExpanderPluginTest extends Unit
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
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Business\ReturnLabelsRestApiCompanyConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyConnector\Communication\Plugin\ReturnLabelsRestApiExtension\CompanyReturnLabelRequestExpanderPlugin
     */
    protected $companyReturnLabelRequestExpanderPlugin;

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

        $this->facadeMock = $this->getMockBuilder(ReturnLabelsRestApiCompanyConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyReturnLabelRequestExpanderPlugin = new CompanyReturnLabelRequestExpanderPlugin();
        $this->companyReturnLabelRequestExpanderPlugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandReturnLabelRequest')
            ->with($this->restReturnLabelRequestTransferMock, $this->returnLabelRequestTransferMock)
            ->willReturn($this->returnLabelRequestTransferMock);

        $returnLabelRequestTransfer = $this->companyReturnLabelRequestExpanderPlugin->expand(
            $this->restReturnLabelRequestTransferMock,
            $this->returnLabelRequestTransferMock,
        );

        static::assertEquals($this->returnLabelRequestTransferMock, $returnLabelRequestTransfer);
    }
}
