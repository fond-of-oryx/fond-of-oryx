<?php

namespace FondOfOryx\Zed\CustomerProductListApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CustomerProductListApi\Business\Model\CustomerProductListApi;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;

class CustomerProductListApiFacadeTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\ApiItemTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiItemTransferMock;

    /**
     * @var \Generated\Shared\Transfer\ApiDataTransfer|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $apiDataTransferMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListApi\Business\Model\CustomerProductListApi|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $customerProductListApiMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListApi\Business\CustomerProductListApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CustomerProductListApi\Business\CustomerProductListApiFacade
     */
    protected $facade;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->apiItemTransferMock = $this
            ->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this
            ->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->customerProductListApiMock = $this
            ->getMockBuilder(CustomerProductListApi::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this
            ->getMockBuilder(CustomerProductListApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CustomerProductListApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testAddCustomerProductList(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCustomerProductListApi')
            ->willReturn($this->customerProductListApiMock);

        $this->customerProductListApiMock->expects(static::atLeastOnce())
            ->method('add')
            ->willReturn($this->apiItemTransferMock);

        static::assertInstanceOf(
            ApiItemTransfer::class,
            $this->facade->addCustomerProductList($this->apiDataTransferMock),
        );
    }
}
