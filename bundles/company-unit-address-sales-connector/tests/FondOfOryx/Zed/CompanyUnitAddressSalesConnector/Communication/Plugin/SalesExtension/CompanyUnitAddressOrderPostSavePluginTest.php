<?php

namespace FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Communication\Plugin\SalesExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\CompanyUnitAddressSalesConnectorFacade;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;

class CompanyUnitAddressOrderPostSavePluginTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SaveOrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $saveOrderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\QuoteTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $quoteTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Business\CompanyUnitAddressSalesConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \FondOfOryx\Zed\CompanyUnitAddressSalesConnector\Communication\Plugin\SalesExtension\CompanyUnitAddressOrderPostSavePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->saveOrderTransferMock = $this->getMockBuilder(SaveOrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facadeMock = $this->getMockBuilder(CompanyUnitAddressSalesConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyUnitAddressOrderPostSavePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('updateFkResourceCompanyUnitAddressForSalesOrderAddress')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteTransferMock);

        static::assertEquals(
            $this->saveOrderTransferMock,
            $this->plugin->execute($this->saveOrderTransferMock, $this->quoteTransferMock),
        );
    }
}
