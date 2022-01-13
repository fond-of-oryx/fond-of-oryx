<?php

namespace FondOfOryx\Zed\CompanyBrandProductListConnector\Communication\Plugin\CompanyProductListConnectorExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyBrandProductListConnector\Business\CompanyBrandProductListConnectorFacade;
use Generated\Shared\Transfer\CompanyProductListRelationTransfer;

class CompanyBrandCompanyProductListRelationPostPersistPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Business\CompanyBrandProductListConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CompanyBrandProductListConnector\Communication\Plugin\CompanyProductListConnectorExtension\CompanyBrandCompanyProductListRelationPostPersistPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CompanyBrandProductListConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListRelationTransferMock = $this->getMockBuilder(CompanyProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CompanyBrandCompanyProductListRelationPostPersistPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPostPersist(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('persistCompanyBrandRelationByCompanyProductListRelation')
            ->with($this->companyProductListRelationTransferMock);

        static::assertEquals(
            $this->companyProductListRelationTransferMock,
            $this->plugin->postPersist($this->companyProductListRelationTransferMock),
        );
    }
}
