<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToApiFacadeInterface;
use FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToCustomerProductListConnectorFacadeInterface;
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
    protected $customerProductListConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CustomerProductListApi\Dependency\Facade\CustomerProductListApiToApiFacadeInterface
     */
    protected $apiFacadeMock;

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

        $this->customerProductListConnectorFacadeMock = $this
            ->getMockBuilder(CustomerProductListApiToCustomerProductListConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiFacadeMock = $this
            ->getMockBuilder(CustomerProductListApiToApiFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new CustomerProductListApi(
            $this->customerProductListConnectorFacadeMock,
            $this->apiFacadeMock,
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

        $this->customerProductListConnectorFacadeMock->expects(static::atLeastOnce())
            ->method('persistCustomerProductListRelation');

        $this->apiFacadeMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        static::assertInstanceOf(
            ApiItemTransfer::class,
            $this->model->add($this->apiDataTransferMock),
        );
    }
}
