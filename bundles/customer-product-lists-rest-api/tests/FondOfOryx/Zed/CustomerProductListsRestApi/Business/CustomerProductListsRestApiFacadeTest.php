<?php

namespace FondOfOryx\Zed\CustomerProductListsRestApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListsRestApi\Business\Persister\CustomerProductListRelationPersisterInterface;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\RestProductListUpdateRequestTransfer;

class CustomerProductListsRestApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\CustomerProductListsRestApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $businessFactoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\Persister\CustomerProductListRelationPersisterInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $customerProductListRelationPersisterMock;

    /**
     * @var \Generated\Shared\Transfer\RestProductListUpdateRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restProductListUpdateRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ProductListTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $productListTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListsRestApi\Business\CustomerProductListsRestApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->businessFactoryMock = $this->getMockBuilder(CustomerProductListsRestApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListRelationPersisterMock = $this->getMockBuilder(CustomerProductListRelationPersisterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestTransferMock = $this->getMockBuilder(RestProductListUpdateRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->productListTransferMock = $this->getMockBuilder(ProductListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CustomerProductListsRestApiFacade();
        $this->facade->setFactory($this->businessFactoryMock);
    }

    /**
     * @return void
     */
    public function testPersistCustomerProductListRelation(): void
    {
        $this->businessFactoryMock->expects(static::atLeastOnce())
            ->method('createCustomerProductListRelationPersister')
            ->willReturn($this->customerProductListRelationPersisterMock);

        $this->customerProductListRelationPersisterMock->expects(static::atLeastOnce())
            ->method('persist')
            ->with($this->restProductListUpdateRequestTransferMock, $this->productListTransferMock);

        $this->facade->persistCustomerProductListRelation(
            $this->restProductListUpdateRequestTransferMock,
            $this->productListTransferMock,
        );
    }
}
