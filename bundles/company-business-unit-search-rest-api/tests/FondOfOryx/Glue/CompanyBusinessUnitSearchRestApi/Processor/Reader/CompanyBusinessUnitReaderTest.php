<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiClientInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\CompanyBusinessUnitListMapperInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitListTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyBusinessUnitReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Mapper\CompanyBusinessUnitListMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitListMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Builder\RestResponseBuilderInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restResponseBuilderMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitSearchRestApi\CompanyBusinessUnitSearchRestApiClientInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
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
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyBusinessUnitListTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitSearchRestApi\Processor\Reader\CompanyBusinessUnitReader
     */
    protected $companyBusinessUnitListReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitListMapperMock = $this->getMockBuilder(CompanyBusinessUnitListMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(CompanyBusinessUnitSearchRestApiClientInterface::class)
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

        $this->companyBusinessUnitListTransferMock = $this->getMockBuilder(CompanyBusinessUnitListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitListReader = new CompanyBusinessUnitReader(
            $this->companyBusinessUnitListMapperMock,
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

        $this->companyBusinessUnitListMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->companyBusinessUnitListTransferMock);

        $this->companyBusinessUnitListTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('searchCompanyBusinessUnit')
            ->with($this->companyBusinessUnitListTransferMock)
            ->willReturn($this->companyBusinessUnitListTransferMock);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUseIsNotSpecifiedRestResponse');

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getMetadata')
            ->willReturn($this->metadataMock);

        $this->metadataMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($locale);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildCompanyBusinessUnitSearchRestResponse')
            ->with($this->companyBusinessUnitListTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->companyBusinessUnitListReader->find($this->restRequestMock),
        );
    }

    /**
     * @return void
     */
    public function testFindWithError(): void
    {
        $this->companyBusinessUnitListMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->companyBusinessUnitListTransferMock);

        $this->companyBusinessUnitListTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn(null);

        $this->clientMock->expects(static::never())
            ->method('searchCompanyBusinessUnit');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildUseIsNotSpecifiedRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restRequestMock->expects(static::never())
            ->method('getMetadata');

        $this->metadataMock->expects(static::never())
            ->method('getLocale');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCompanyBusinessUnitSearchRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->companyBusinessUnitListReader->find($this->restRequestMock),
        );
    }
}
