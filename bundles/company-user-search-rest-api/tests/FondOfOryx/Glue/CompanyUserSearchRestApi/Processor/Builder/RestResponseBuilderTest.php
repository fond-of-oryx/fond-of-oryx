<?php

namespace FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanyUserSearchRestApi\CompanyUserSearchRestApiConfig;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchAttributesMapperInterface;
use FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator\RestCompanyUserSearchAttributesTranslatorInterface;
use Generated\Shared\Transfer\CompanyUserListTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer;
use Generated\Shared\Transfer\RestCompanyUserSearchPaginationTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Mapper\RestCompanyUserSearchAttributesMapperInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUserSearchAttributesMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface|mixed
     */
    protected $restResourceBuilderMock;

    /**
     * @var \Generated\Shared\Transfer\CompanyUserListTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $companyUserListTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUserSearchAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUserSearchAttributesTransferMock;

    /**
     * @var \Generated\Shared\Transfer\RestCompanyUserSearchPaginationTransfer|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUserSearchPaginationTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|mixed
     */
    protected $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface|mixed
     */
    protected $restResponseMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Translator\RestCompanyUserSearchAttributesTranslatorInterface|\PHPUnit\Framework\MockObject\MockObject|mixed
     */
    protected $restCompanyUserSearchAttributesTranslatorMock;

    /**
     * @var \FondOfOryx\Glue\CompanyUserSearchRestApi\Processor\Builder\RestResponseBuilder
     */
    protected $restResponseBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restCompanyUserSearchAttributesMapperMock = $this->getMockBuilder(RestCompanyUserSearchAttributesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyUserListTransferMock = $this->getMockBuilder(CompanyUserListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchAttributesTransferMock = $this->getMockBuilder(RestCompanyUserSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchPaginationTransferMock = $this->getMockBuilder(RestCompanyUserSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restCompanyUserSearchAttributesTranslatorMock = $this->getMockBuilder(RestCompanyUserSearchAttributesTranslatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new RestResponseBuilder(
            $this->restCompanyUserSearchAttributesTranslatorMock,
            $this->restCompanyUserSearchAttributesMapperMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testBuildCompanyUserSearchRestResponse(): void
    {
        $locale = 'de_DE';
        $numFound = 100;

        $this->restCompanyUserSearchAttributesMapperMock->expects(static::atLeastOnce())
            ->method('fromCompanyUserList')
            ->with($this->companyUserListTransferMock)
            ->willReturn($this->restCompanyUserSearchAttributesTransferMock);

        $this->restCompanyUserSearchAttributesTranslatorMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($this->restCompanyUserSearchAttributesTransferMock)
            ->willReturn($this->restCompanyUserSearchAttributesTransferMock);

        $this->restCompanyUserSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn($this->restCompanyUserSearchPaginationTransferMock);

        $this->restCompanyUserSearchPaginationTransferMock->expects(static::atLeastOnce())
            ->method('getNumFound')
            ->willReturn($numFound);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->with($numFound)
            ->willReturn($this->restResponseMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                CompanyUserSearchRestApiConfig::RESOURCE_COMPANY_USER_SEARCH,
                null,
                $this->restCompanyUserSearchAttributesTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildCompanyUserSearchRestResponse(
                $this->companyUserListTransferMock,
                $locale,
            ),
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
                        return $restErrorMessageTransfer->getCode() === CompanyUserSearchRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED
                            && $restErrorMessageTransfer->getDetail() === CompanyUserSearchRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED
                            && $restErrorMessageTransfer->getStatus() === Response::HTTP_FORBIDDEN;
                    },
                ),
            )->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildUseIsNotSpecifiedRestResponse(),
        );
    }
}
