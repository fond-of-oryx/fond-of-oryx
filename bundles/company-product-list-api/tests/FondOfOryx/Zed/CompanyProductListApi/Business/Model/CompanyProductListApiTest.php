<?php

namespace FondOfOryx\Zed\CompanyProductListApi\Business\Model;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeInterface;
use FondOfOryx\Zed\CompanyProductListApi\Dependency\QueryContainer\CompanyProductListApiToApiQueryContainerInterface;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;

class CompanyProductListApiTest extends Unit
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
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyProductListApi\Dependency\Facade\CompanyProductListApiToCompanyProductListConnectorFacadeInterface
     */
    protected $companyProductListApiToCompanyProductListConnectorFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyProductListApi\Dependency\QueryContainer\CompanyProductListApiToApiQueryContainerInterface
     */
    protected $companyProductListApiToApiQueryContainerMock;

    /**
     * @var \FondOfOryx\Zed\CompanyProductListApi\Business\Model\CompanyProductListApi
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

        $this->companyProductListApiToCompanyProductListConnectorFacadeMock = $this
            ->getMockBuilder(CompanyProductListApiToCompanyProductListConnectorFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyProductListApiToApiQueryContainerMock = $this
            ->getMockBuilder(CompanyProductListApiToApiQueryContainerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->model = new CompanyProductListApi(
            $this->companyProductListApiToCompanyProductListConnectorFacadeMock,
            $this->companyProductListApiToApiQueryContainerMock,
        );
    }

    /**
     * @return void
     */
    public function testAdd(): void
    {
        $this->apiDataTransferMock->expects(static::atLeastOnce())
            ->method('getData')
            ->willReturn(['fk_company' => 1]);

        $this->companyProductListApiToCompanyProductListConnectorFacadeMock->expects(static::atLeastOnce())
            ->method('persistCompanyProductListRelation');

        $this->companyProductListApiToApiQueryContainerMock->expects(static::atLeastOnce())
            ->method('createApiItem')
            ->willReturn($this->apiItemTransferMock);

        static::assertInstanceOf(
            ApiItemTransfer::class,
            $this->model->add($this->apiDataTransferMock),
        );
    }
}
