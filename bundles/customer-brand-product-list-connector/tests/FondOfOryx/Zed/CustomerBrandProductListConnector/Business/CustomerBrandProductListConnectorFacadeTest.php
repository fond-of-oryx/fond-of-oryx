<?php

namespace FondOfOryx\Zed\CustomerBrandProductListConnector\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Persister\CustomerBrandRelationPersisterInterface;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class CustomerBrandProductListConnectorFacadeTest extends Unit
{
 /**
  * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\Persister\CustomerBrandRelationPersisterInterface|\PHPUnit\Framework\MockObject\MockObject
  */
    protected $customerBrandRelationPersisterMock;

    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\CustomerBrandProductListConnectorBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $factoryMock;

    /**
     * @var \Generated\Shared\Transfer\CustomerProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerBrandProductListConnector\Business\CustomerBrandProductListConnectorFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerBrandRelationPersisterMock = $this->getMockBuilder(CustomerBrandRelationPersisterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this->getMockBuilder(CustomerBrandProductListConnectorBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListRelationTransferMock = $this->getMockBuilder(CustomerProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CustomerBrandProductListConnectorFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testPersistCustomerBrandRelationByCustomerProductListRelation(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCustomerBrandRelationPersister')
            ->willReturn($this->customerBrandRelationPersisterMock);

        $this->customerBrandRelationPersisterMock->expects(static::atLeastOnce())
            ->method('persistByCustomerProductListRelation')
            ->with($this->customerProductListRelationTransferMock);

        $this->facade->persistCustomerBrandRelationByCustomerProductListRelation(
            $this->customerProductListRelationTransferMock,
        );
    }
}
