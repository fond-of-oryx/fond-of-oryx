<?php

namespace FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Communication\Plugin;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\CompanyDeleterErpDeliveryNoteConnectorFacade;
use Generated\Shared\Transfer\CompanyTransfer;

class ErpDeliveryNoteDeleterPrePluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Business\CompanyDeleterErpDeliveryNoteConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyDeleterErpDeliveryNoteConnector\Communication\Plugin\ErpDeliveryNoteDeleterPrePlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before()
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyDeleterErpDeliveryNoteConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new ErpDeliveryNoteDeleterPrePlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testExecute()
    {
        $this->facadeMock->expects(static::atLeastOnce())->method('deleteErpDeliveryNoteDataForCompanyById');
        $this->plugin->execute($this->companyTransferMock);
    }
}
