<?php

namespace FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\CompanyBusinessUnitAddressSearchRestApiConfig;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Translator\RestCompanyBusinessUnitAddressSearchAttributesTranslatorInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchPaginationTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Mapper\RestCompanyBusinessUnitAddressSearchAttributesMapperInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyBusinessUnitAddressSearchAttributesMapperMock;

    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyBusinessUnitAddressListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyBusinessUnitAddressListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchAttributesTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyBusinessUnitAddressSearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyBusinessUnitAddressSearchPaginationTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyBusinessUnitAddressSearchPaginationTransferMock;

    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Translator\RestCompanyBusinessUnitAddressSearchAttributesTranslatorInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanyBusinessUnitAddressSearchAttributesTranslatorMock;

    /**
     * @var \FondOfOryx\Glue\CompanyBusinessUnitAddressSearchRestApi\Processor\Builder\RestResponseBuilder
     */
    protected $restResponseBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restCompanyBusinessUnitAddressSearchAttributesMapperMock = $this->getMockBuilder(RestCompanyBusinessUnitAddressSearchAttributesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyBusinessUnitAddressListTransferMock = $this->getMockBuilder(CompanyBusinessUnitAddressListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchAttributesTransferMock = $this->getMockBuilder(RestCompanyBusinessUnitAddressSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchPaginationTransferMock = $this->getMockBuilder(RestCompanyBusinessUnitAddressSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyBusinessUnitAddressSearchAttributesTranslatorMock = $this->getMockBuilder(RestCompanyBusinessUnitAddressSearchAttributesTranslatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new RestResponseBuilder(
            $this->restCompanyBusinessUnitAddressSearchAttributesTranslatorMock,
            $this->restCompanyBusinessUnitAddressSearchAttributesMapperMock,
            $this->restResourceBuilderMock
        );
    }

    /**
     * @return void
     */
    public function testBuildCompanyBusinessUnitAddressSearchRestResponse(): void
    {
        $locale = 'de_DE';
        $numFound = 100;

        $this->restCompanyBusinessUnitAddressSearchAttributesMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyBusinessUnitAddressList')
            ->with($this->companyBusinessUnitAddressListTransferMock)
            ->willReturn($this->restCompanyBusinessUnitAddressSearchAttributesTransferMock);

        $this->restCompanyBusinessUnitAddressSearchAttributesTranslatorMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($this->restCompanyBusinessUnitAddressSearchAttributesTransferMock)
            ->willReturn($this->restCompanyBusinessUnitAddressSearchAttributesTransferMock);

        $this->restCompanyBusinessUnitAddressSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn($this->restCompanyBusinessUnitAddressSearchPaginationTransferMock);

        $this->restCompanyBusinessUnitAddressSearchPaginationTransferMock->expects(static::atLeastOnce())
            ->method('getNumFound')
            ->willReturn($numFound);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->with($numFound)
            ->willReturn($this->restResponseMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                CompanyBusinessUnitAddressSearchRestApiConfig::RESOURCE_COMPANY_BUSINESS_UNIT_ADDRESS_SEARCH,
                null,
                $this->restCompanyBusinessUnitAddressSearchAttributesTransferMock
            )->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildCompanyBusinessUnitAddressSearchRestResponse(
                $this->companyBusinessUnitAddressListTransferMock,
                $locale
            )
        );
    }

    /**
     * @return void
     */
    public function testBuildUseIsNotSpecifiedRestResponse(): void
    {
        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->willReturn($this->restResponseMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addError')
            ->with(
                static::callback(
                    static function (RestErrorMessageTransfer $restErrorMessageTransfer) {
                        return $restErrorMessageTransfer->getCode() === CompanyBusinessUnitAddressSearchRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED
                            && $restErrorMessageTransfer->getDetail() === CompanyBusinessUnitAddressSearchRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_FORBIDDEN;
                    }
                )
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildUseIsNotSpecifiedRestResponse()
        );
    }
}
