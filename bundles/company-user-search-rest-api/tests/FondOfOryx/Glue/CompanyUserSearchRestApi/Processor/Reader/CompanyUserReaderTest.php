<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyUserSearchRestApi\CompanyUserSearchRestApiClientInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\CompanyUserListMapperInterface;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyUserReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\CompanyUserListMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserListMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Builder\RestResponseBuilderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restResponseBuilderMock;

    /**
     * @var \FondOfOryx\Client\CompanyUserSearchRestApi\CompanyUserSearchRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
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
     * @var \Generated\Shared\Transfer\CompanyUserListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserListTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Reader\CompanyUserReader
     */
    protected $companyUserReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyUserListMapperMock = $this->getMockBuilder(CompanyUserListMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(CompanyUserSearchRestApiClientInterface::class)
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

        $this->companyUserListTransferMock = $this->getMockBuilder(CompanyUserListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserReader = new CompanyUserReader(
            $this->companyUserListMapperMock,
            $this->restResponseBuilderMock,
            $this->clientMock,
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $customerReference = 'FOO-C--1';
        $locale = 'de_DE';

        $this->companyUserListMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->companyUserListTransferMock);

        $this->companyUserListTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('searchCompanyUser')
            ->with($this->companyUserListTransferMock)
            ->willReturn($this->companyUserListTransferMock);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUseIsNotSpecifiedRestResponse');

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getMetadata')
            ->willReturn($this->metadataMock);

        $this->metadataMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($locale);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildCompanyUserSearchRestResponse')
            ->with($this->companyUserListTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->companyUserReader->find($this->restRequestMock),
        );
    }

    /**
     * @return void
     */
    public function testFindWithError(): void
    {
        $this->companyUserListMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->companyUserListTransferMock);

        $this->companyUserListTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn(null);

        $this->clientMock->expects(static::never())
            ->method('searchCompanyUser');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildUseIsNotSpecifiedRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restRequestMock->expects(static::never())
            ->method('getMetadata');

        $this->metadataMock->expects(static::never())
            ->method('getLocale');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCompanyUserSearchRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->companyUserReader->find($this->restRequestMock),
        );
    }
}
