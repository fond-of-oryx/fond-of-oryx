<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Communication\Plugin\CustomerProductListConnectorExtension;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Business\CustomerBrandProductListConnectorFacade;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class CustomerBrandCustomerProductListRelationPostPersistPluginTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\CustomerBrandProductListConnectorFacade|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $facadeMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Communication\Plugin\CustomerProductListConnectorExtension\CustomerBrandCustomerProductListRelationPostPersistPlugin
     */
    protected $plugin;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->facadeMock = $this->getMockBuilder(CustomerBrandProductListConnectorFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListRelationTransferMock = $this->getMockBuilder(CustomerProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->plugin = new CustomerBrandCustomerProductListRelationPostPersistPlugin();
        $this->plugin->setFacade($this->facadeMock);
    }

    /**
     * @return void
     */
    public function testPostPersist(): void
    {
        $this->facadeMock->expects(static::atLeastOnce())
            ->method('persistCustomerBrandRelationByCustomerProductListRelation')
            ->with($this->customerProductListRelationTransferMock);

        static::assertEquals(
            $this->customerProductListRelationTransferMock,
            $this->plugin->postPersist($this->customerProductListRelationTransferMock),
        );
    }
}
