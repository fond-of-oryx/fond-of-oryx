<?php

namespace FondOfOryx\Zed\CompanyRoleApi\Business;

use Codeception\Test\Unit;
use FondOfOryx\Zed\CompanyRoleApi\Business\Model\CompanyRoleApi;
use Generated\Shared\Transfer\ApiCollectionTransfer;
use Generated\Shared\Transfer\ApiDataTransfer;
use Generated\Shared\Transfer\ApiItemTransfer;
use Generated\Shared\Transfer\ApiRequestTransfer;

class CompanyRoleApiFacadeTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\CompanyRoleApi\Business\CompanyRoleApiFacade
     */
    protected $companyRoleApiFacade;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyRoleApi\Business\CompanyRoleApiBusinessFactory
     */
    protected $companyRoleApiBusinessFactoryMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Zed\CompanyRoleApi\Business\Model\CompanyRoleApi
     */
    protected $companyRoleApiMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiDataTransfer
     */
    protected $apiDataTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiItemTransfer
     */
    protected $apiItemTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiRequestTransfer
     */
    protected $apiRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\ApiCollectionTransfer
     */
    protected $apiCollectionTransferMock;

    /**
     * @var int
     */
    protected $idCompanyRole;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyRoleApiBusinessFactoryMock = $this->getMockBuilder(CompanyRoleApiBusinessFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleApiMock = $this->getMockBuilder(CompanyRoleApi::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiDataTransferMock = $this->getMockBuilder(ApiDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiItemTransferMock = $this->getMockBuilder(ApiItemTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiRequestTransferMock = $this->getMockBuilder(ApiRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->apiCollectionTransferMock = $this->getMockBuilder(ApiCollectionTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->idCompanyRole = 1;

        $this->companyRoleApiFacade = new CompanyRoleApiFacade();
        $this->companyRoleApiFacade->setFactory($this->companyRoleApiBusinessFactoryMock);
    }

    /**
     * @return void
     */
    public function testGetCompany(): void
    {
        $this->companyRoleApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyRoleApi')
            ->willReturn($this->companyRoleApiMock);

        $this->companyRoleApiMock->expects(static::atLeastOnce())
            ->method('get')
            ->with($this->idCompanyRole)
            ->willReturn($this->apiItemTransferMock);

        static::assertEquals(
            $this->apiItemTransferMock,
            $this->companyRoleApiFacade->getCompanyRole($this->idCompanyRole),
        );
    }

    /**
     * @return void
     */
    public function testFindCompanies(): void
    {
        $this->companyRoleApiBusinessFactoryMock->expects(static::atLeastOnce())
            ->method('createCompanyRoleApi')
            ->willReturn($this->companyRoleApiMock);

        $this->companyRoleApiMock->expects(static::atLeastOnce())
            ->method('find')
            ->with($this->apiRequestTransferMock)
            ->willReturn($this->apiCollectionTransferMock);

        static::assertEquals(
            $this->apiCollectionTransferMock,
            $this->companyRoleApiFacade->findCompanyRoles($this->apiRequestTransferMock),
        );
    }
}
