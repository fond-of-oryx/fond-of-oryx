<?php

namespace FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiClientInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\CompanyRoleListMapperInterface;
use Generated\Shared\Transfer\CompanyRoleListTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyRoleReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Mapper\CompanyRoleListMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleListMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Builder\RestResponseBuilderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restResponseBuilderMock;

    /**
     * @var \FondOfOryx\Client\CompanyRoleSearchRestApi\CompanyRoleSearchRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface|mixed
     */
    protected $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface|mixed
     */
    protected $metadataMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface|mixed
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyRoleListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyRoleListTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyRoleSearchRestApi\Processor\Reader\CompanyRoleReader
     */
    protected $companyRoleReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyRoleListMapperMock = $this->getMockBuilder(CompanyRoleListMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(CompanyRoleSearchRestApiClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->metadataMock = $this->getMockBuilder(MetadataInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleListTransferMock = $this->getMockBuilder(CompanyRoleListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyRoleReader = new CompanyRoleReader(
            $this->companyRoleListMapperMock,
            $this->restResponseBuilderMock,
            $this->clientMock,
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $customerReference = 'CUSTOMER-REFERENCE';
        $locale = 'en_US';

        $this->companyRoleListMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->companyRoleListTransferMock);

        $this->companyRoleListTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('searchCompanyRoles')
            ->with($this->companyRoleListTransferMock)
            ->willReturn($this->companyRoleListTransferMock);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUseIsNotSpecifiedRestResponse');

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getMetadata')
            ->willReturn($this->metadataMock);

        $this->metadataMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($locale);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildCompanyRoleSearchRestResponse')
            ->with($this->companyRoleListTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->companyRoleReader->find($this->restRequestMock),
        );
    }

    /**
     * @return void
     */
    public function testFindWithError(): void
    {
        $this->companyRoleListMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->companyRoleListTransferMock);

        $this->companyRoleListTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn(null);

        $this->clientMock->expects(static::never())
            ->method('searchCompanyRoles');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildUseIsNotSpecifiedRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restRequestMock->expects(static::never())
            ->method('getMetadata');

        $this->metadataMock->expects(static::never())
            ->method('getLocale');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCompanyRoleSearchRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->companyRoleReader->find($this->restRequestMock),
        );
    }
}
