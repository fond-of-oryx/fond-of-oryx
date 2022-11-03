<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Communication\Plugin\ReturnLabelsRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\ReturnLabelsRestApiCompanyBusinessUnitConnectorFacade;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class CompanyBusinessUnitReturnLabelRequestExpanderPluginTest extends Unit
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
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Business\ReturnLabelsRestApiCompanyBusinessUnitConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyBusinessUnitConnector\Communication\Plugin\ReturnLabelsRestApiExtension\CompanyBusinessUnitReturnLabelRequestExpanderPlugin
     */
    protected $plugin;

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

        $this->facadeMock = $this->getMockBuilder(ReturnLabelsRestApiCompanyBusinessUnitConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyBusinessUnitReturnLabelRequestExpanderPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExpand(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('expandReturnLabelRequest')
            ->with(
                $this->restReturnLabelRequestTransferMock,
                $this->returnLabelRequestTransferMock,
            )
            ->willReturn($this->returnLabelRequestTransferMock);

        static::assertEquals($this->returnLabelRequestTransferMock, $this->plugin->expand(
            $this->restReturnLabelRequestTransferMock,
            $this->returnLabelRequestTransferMock,
        ));
    }
}
