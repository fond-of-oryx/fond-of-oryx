<?php

namespace FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClientInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyMapperInterface;
use FondOfOryx\Glue\CompaniesRestApi\Processor\Permission\PermissionCheckerInterface;
use Generated\Shared\Transfer\CompanyTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyDeleterTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Processor\Mapper\CompanyMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Processor\Builder\RestResponseBuilderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseBuilderMock;

    /**
     * @var \FondOfOryx\Client\CompaniesRestApi\CompaniesRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfOryx\Glue\CompaniesRestApi\Processor\Permission\PermissionCheckerInterface
     */
    protected $permissionCheckerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\CompanyTransfer
     */
    protected $companyTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompaniesRestApi\Processor\Deleter\CompanyDeleter
     */
    protected $deleter;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyMapperMock = $this->getMockBuilder(CompanyMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(CompaniesRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->permissionCheckerMock = $this->getMockBuilder(PermissionCheckerInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyTransferMock = $this->getMockBuilder(CompanyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->deleter = new CompanyDeleter(
            $this->clientMock,
            $this->companyMapperMock,
            $this->restResponseBuilderMock,
            $this->permissionCheckerMock,
        );
    }

    /**
     * @return void
     */
    public function testDelete(): void
    {
        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCompanyDeleterMissingPermissionResponse');

        $this->permissionCheckerMock->expects(static::once())
            ->method('can')
            ->willReturn(true);

        $this->companyMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->companyTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('deleteCompany')
            ->with($this->companyTransferMock)
            ->willReturn($this->companyTransferMock);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildCompanyDeleterRestResponse')
            ->with($this->companyTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->deleter->delete($this->restRequestMock),
        );
    }

    /**
     * @return void
     */
    public function testDeleteWithMissingPermission(): void
    {
        $this->restResponseBuilderMock->expects(static::once())
            ->method('buildCompanyDeleterMissingPermissionResponse')
            ->willReturn($this->restResponseMock);

        $this->permissionCheckerMock->expects(static::once())
            ->method('can')->willReturn(false);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCompanyDeleterRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->deleter->delete($this->restRequestMock),
        );
    }
}
