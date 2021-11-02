<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Communication\Plugin\ReturnLabelsRestApiExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\ReturnLabelsRestApiCustomerConnectorFacade;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class CustomerReturnLabelRequestExpanderPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\ReturnLabelsRestApiCustomerConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\RestReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restReturnLabelRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ReturnLabelRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $returnLabelRequestTransferMock;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Communication\Plugin\ReturnLabelsRestApiExtension\CustomerReturnLabelRequestExpanderPlugin
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

        $this->facadeMock = $this->getMockBuilder(ReturnLabelsRestApiCustomerConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->returnLabelRequestTransferMock = $this->getMockBuilder(ReturnLabelRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerReturnLabelRequestExpanderPlugin();
        $this->plugin->setFacade($this->facadeMock);
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

        static::assertEquals(
            $this->returnLabelRequestTransferMock,
            $this->plugin->expand($this->restReturnLabelRequestTransferMock, $this->returnLabelRequestTransferMock),
        );
    }
}
