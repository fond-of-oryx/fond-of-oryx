<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\QueryContainer\CustomerProductListApiToApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;

class CustomerProductListApiTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface
     */
    protected $customerProductListApiToCustomerProductListConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CustomerProductListApi\Dependency\QueryContainer\CustomerProductListApiToApiQueryContainerInterface
     */
    protected $customerProductListApiToApiQueryContainerMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListApi\Business\Model\CustomerProductListApi
     */
    protected $model;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiDataTransferMock = $this
            ->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this
            ->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListApiToCustomerProductListConnectorFacadeMock = $this
            ->getMockBuilder(CustomerProductListApiToCustomerProductListConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListApiToApiQueryContainerMock = $this
            ->getMockBuilder(CustomerProductListApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new CustomerProductListApi(
            $this->customerProductListApiToCustomerProductListConnectorFacadeMock,
            $this->customerProductListApiToApiQueryContainerMock,
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn(['fk_customer' => 1]);

        $this->customerProductListApiToCustomerProductListConnectorFacadeMock->expects(static::atLeastOnce())
            ->method('persistCustomerProductListRelation');

        $this->customerProductListApiToApiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        static::assertInstanceOf(
            ApiItemTransfer::class,
            $this->model->add($this->apiDataTransferMock),
        );
    }
}
