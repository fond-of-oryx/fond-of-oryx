<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanySearchRestApi\CompanySearchRestApiConfig;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Translator\RestCompanySearchAttributesTranslatorInterface;
use Generated\Shared\Transfer\CompanyListTransfer;
use Generated\Shared\Transfer\RestCompanySearchAttributesTransfer;
use Generated\Shared\Transfer\RestCompanySearchPaginationTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\RestCompanySearchAttributesMapperInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanySearchAttributesMapperMock;

    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface
     */
    protected $restResourceBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyListTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $companyListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanySearchAttributesTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanySearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanySearchPaginationTransfer|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanySearchPaginationTransferMock;

    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResourceMock;

    /**
     * @var mixed|\PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Translator\RestCompanySearchAttributesTranslatorInterface|mixed|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restCompanySearchAttributesTranslatorMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Builder\RestResponseBuilder
     */
    protected $restResponseBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restCompanySearchAttributesMapperMock = $this->getMockBuilder(RestCompanySearchAttributesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyListTransferMock = $this->getMockBuilder(CompanyListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanySearchAttributesTransferMock = $this->getMockBuilder(RestCompanySearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanySearchPaginationTransferMock = $this->getMockBuilder(RestCompanySearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanySearchAttributesTranslatorMock = $this->getMockBuilder(RestCompanySearchAttributesTranslatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new RestResponseBuilder(
            $this->restCompanySearchAttributesTranslatorMock,
            $this->restCompanySearchAttributesMapperMock,
            $this->restResourceBuilderMock
        );
    }

    /**
     * @return void
     */
    public function testBuildCompanySearchRestResponse(): void
    {
        $locale = 'de_DE';
        $numFound = 100;

        $this->restCompanySearchAttributesMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyList')
            ->with($this->companyListTransferMock)
            ->willReturn($this->restCompanySearchAttributesTransferMock);

        $this->restCompanySearchAttributesTranslatorMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($this->restCompanySearchAttributesTransferMock)
            ->willReturn($this->restCompanySearchAttributesTransferMock);

        $this->restCompanySearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn($this->restCompanySearchPaginationTransferMock);

        $this->restCompanySearchPaginationTransferMock->expects(static::atLeastOnce())
            ->method('getNumFound')
            ->willReturn($numFound);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->with($numFound)
            ->willReturn($this->restResponseMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                CompanySearchRestApiConfig::RESOURCE_COMPANY_SEARCH,
                null,
                $this->restCompanySearchAttributesTransferMock
            )->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildCompanySearchRestResponse(
                $this->companyListTransferMock,
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
                        return $restErrorMessageTransfer->getCode() === CompanySearchRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED
                            && $restErrorMessageTransfer->getDetail() === CompanySearchRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED
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
