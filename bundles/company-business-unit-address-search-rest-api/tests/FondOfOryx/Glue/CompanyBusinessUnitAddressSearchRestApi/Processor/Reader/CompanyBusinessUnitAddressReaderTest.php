<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiClientInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\CompanyBusinessUnitAddressListMapperInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyBusinessUnitAddressReaderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\CompanyBusinessUnitAddressListMapperInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitAddressListMapperMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Builder\RestResponseBuilderInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restResponseBuilderMock;

    /**
     * @var \FondOfOryx\Client\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiClientInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $clientMock;

    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface
     */
    protected $metadataMock;

    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface
     */
    protected $restResponseMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitAddressListTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Reader\CompanyBusinessUnitAddressReader
     */
    protected $companyBusinessUnitAddressListReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->companyBusinessUnitAddressListMapperMock = $this->getMockBuilder(CompanyBusinessUnitAddressListMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(CompanyBusinessUnitAddressSearchRestApiClientInterface::class)
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

        $this->companyBusinessUnitAddressListTransferMock = $this->getMockBuilder(CompanyBusinessUnitAddressListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitAddressListReader = new CompanyBusinessUnitAddressReader(
            $this->companyBusinessUnitAddressListMapperMock,
            $this->restResponseBuilderMock,
            $this->clientMock
        );
    }

    /**
     * @return void
     */
    public function testFind(): void
    {
        $customerReference = 'FOO-C--1';
        $locale = 'de_DE';

        $this->companyBusinessUnitAddressListMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->companyBusinessUnitAddressListTransferMock);

        $this->companyBusinessUnitAddressListTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn($customerReference);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('searchCompanyBusinessUnitAddress')
            ->with($this->companyBusinessUnitAddressListTransferMock)
            ->willReturn($this->companyBusinessUnitAddressListTransferMock);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUseIsNotSpecifiedRestResponse');

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getMetadata')
            ->willReturn($this->metadataMock);

        $this->metadataMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($locale);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildCompanyBusinessUnitAddressSearchRestResponse')
            ->with($this->companyBusinessUnitAddressListTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->companyBusinessUnitAddressListReader->find($this->restRequestMock)
        );
    }

    /**
     * @return void
     */
    public function testFindWithError(): void
    {
        $this->companyBusinessUnitAddressListMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->companyBusinessUnitAddressListTransferMock);

        $this->companyBusinessUnitAddressListTransferMock->expects(static::atLeastOnce())
            ->method('getCustomerReference')
            ->willReturn(null);

        $this->clientMock->expects(static::never())
            ->method('searchCompanyBusinessUnitAddress');

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildUseIsNotSpecifiedRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restRequestMock->expects(static::never())
            ->method('getMetadata');

        $this->metadataMock->expects(static::never())
            ->method('getLocale');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildCompanyBusinessUnitAddressSearchRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->companyBusinessUnitAddressListReader->find($this->restRequestMock)
        );
    }
}
