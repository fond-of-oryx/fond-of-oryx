<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Permission;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompaniesRestApiPermissionInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\PermissionRequestMapperInterface;
use FondOfOryx\Shared\CompaniesRestApi\CompaniesRestApiConstants;
use Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class PermissionCheckerTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompaniesRestApiPermissionRequestTransfer
     */
    protected $companiesRestApiPermissionRequestTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompaniesRestApi\Dependency\Client\CompaniesRestApiToCompaniesRestApiPermissionInterface
     */
    protected $permissionClientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\PermissionRequestMapperInterface
     */
    protected $permissionRequestMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Processor\Permission\PermissionChecker
     */
    protected $permissionChecker;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companiesRestApiPermissionRequestTransferMock = $this->getMockBuilder(CompaniesRestApiPermissionRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionClientMock = $this->getMockBuilder(CompaniesRestApiToCompaniesRestApiPermissionInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionRequestMapperMock = $this->getMockBuilder(PermissionRequestMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionChecker = new PermissionChecker(
            $this->permissionClientMock,
            $this->permissionRequestMapperMock,
        );
    }

    /**
     * @return void
     */
    public function testCan(): void
    {
        $this->permissionRequestMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->willReturn($this->companiesRestApiPermissionRequestTransferMock);

        $this->companiesRestApiPermissionRequestTransferMock->expects(static::atLeastOnce())
            ->method('setPermissionKey')
            ->with(CompaniesRestApiConstants::PERMISSION_KEY)
            ->willReturnSelf();

        $this->permissionClientMock->expects(static::atLeastOnce())
            ->method('hasPermissionToDeleteCompany')
            ->willReturn(true);

        $this->permissionChecker->can($this->restRequestMock);
    }
}
