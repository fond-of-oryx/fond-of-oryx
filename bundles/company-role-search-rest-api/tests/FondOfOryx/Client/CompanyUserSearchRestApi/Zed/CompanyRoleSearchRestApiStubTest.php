<?php

namespace FondOfOryx\Client\CompanyRoleSearchRestApi\Zed;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToZedRequestClientInterface;
use Generated\Shared\Transfer\CompanyRoleListTransfer;

class CompanyRoleSearchRestApiStubTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\CompanyRoleListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleListTransferMock;

    /**
     * @var \FondOfOryx\Client\CompanyRoleSearchRestApi\Dependency\Client\CompanyRoleSearchRestApiToZedRequestClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $zedRequestClientMock;

    /**
     * @var \FondOfOryx\Client\CompanyRoleSearchRestApi\Zed\CompanyRoleSearchRestApiStub
     */
    protected $companyRoleSearchRestApiStub;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyRoleListTransferMock = $this->getMockBuilder(CompanyRoleListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->zedRequestClientMock = $this->getMockBuilder(CompanyRoleSearchRestApiToZedRequestClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleSearchRestApiStub = new CompanyRoleSearchRestApiStub($this->zedRequestClientMock);
    }

    /**
     * @return void
     */
    public function testSearchCompanyRole(): void
    {
        $this->zedRequestClientMock->expects(static::atLeastOnce())
            ->method('call')
            ->with(
                '/company-role-search-rest-api/gateway/search-company-roles',
                $this->companyRoleListTransferMock,
            )->willReturn($this->companyRoleListTransferMock);

        static::assertEquals(
            $this->companyRoleListTransferMock,
            $this->companyRoleSearchRestApiStub->searchCompanyRoles($this->companyRoleListTransferMock),
        );
    }
}
