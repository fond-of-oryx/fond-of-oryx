<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorFacadeInterface;
use Generated\Shared\Transfer\CustomerProductListRelationTransfer;

class CustomerProductListApiToCustomerProductListConnectorFacadeBridgeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CustomerProductListRelationTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $customerProductListRelationTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListConnector\Business\CustomerProductListConnectorFacadeInterface|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $customerProductListConnectorFacadeMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface
     */
    protected $dependencyFacade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerProductListRelationTransferMock = $this
            ->getMockBuilder(CustomerProductListRelationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListConnectorFacadeMock = $this
            ->getMockBuilder(CustomerProductListConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->dependencyFacade = new CustomerProductListApiToCustomerProductListConnectorFacadeBridge(
            $this->customerProductListConnectorFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testPersistCustomerProductListRelation(): void
    {
        $this->dependencyFacade->persistCustomerProductListRelation($this->customerProductListRelationTransferMock);
    }
}
