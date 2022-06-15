<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListApi\Business\Model\CompanyProductListApi;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;

class CompanyProductListApiFacadeTest extends Unit
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
     * @var \FondOfOryx\Zed\CompanyProductListApi\Business\Model\CompanyProductListApi|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $companyProductListApiMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListApi\Business\CompanyProductListApiBusinessFactory|\PHPUnit\Framework\MockObject\MockObject|null
     */
    protected $factoryMock;

    /**
     * @var \FondOfOryx\Zed\CopanyProductListApi\Business\CompanyProductListApiFacade
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

        $this->companyProductListApiMock = $this
            ->getMockBuilder(CompanyProductListApi::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->factoryMock = $this
            ->getMockBuilder(CompanyProductListApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->facade = new CompanyProductListApiFacade();
        $this->facade->setFactory($this->factoryMock);
    }

    /**
     * @return void
     */
    public function testAddCompanyProductList(): void
    {
        $this->factoryMock->expects(static::atLeastOnce())
            ->method('createCompanyProductListApi')
            ->willReturn($this->companyProductListApiMock);

        $this->companyProductListApiMock->expects(static::atLeastOnce())
            ->method('add')
            ->willReturn($this->apiItemTransferMock);

        static::assertInstanceOf(
            ApiItemTransfer::class,
            $this->facade->addCompanyProductList($this->apiDataTransferMock),
        );
    }
}
