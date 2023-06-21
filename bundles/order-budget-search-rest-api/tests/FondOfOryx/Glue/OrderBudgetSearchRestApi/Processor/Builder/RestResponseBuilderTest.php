<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Builder;

use Codeception\Test\Unit;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiConfig;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchAttributesMapperInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator\RestOrderBudgetSearchAttributesTranslatorInterface;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use Generated\Shared\Transfer\RestErrorMessageTransfer;
use Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer;
use Generated\Shared\Transfer\RestOrderBudgetSearchPaginationTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Symfony\Component\HttpFoundation\Response;

class RestResponseBuilderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\RestOrderBudgetSearchAttributesMapperInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestOrderBudgetSearchAttributesMapperInterface $restOrderBudgetSearchAttributesMapperMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceBuilderInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestResourceBuilderInterface|MockObject $restResourceBuilderMock;

    /**
     * @var (\Generated\Shared\Transfer\OrderBudgetListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetListTransfer|MockObject $orderBudgetListTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\RestOrderBudgetSearchAttributesTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestOrderBudgetSearchAttributesTransfer|MockObject $restOrderBudgetSearchAttributesTransferMock;

    /**
     * @var (\Generated\Shared\Transfer\RestOrderBudgetSearchPaginationTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestOrderBudgetSearchPaginationTransfer|MockObject $restOrderBudgetSearchPaginationTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResourceInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MockObject|RestResourceInterface $restResourceMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestResponseInterface|MockObject $restResponseMock;

    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Translator\RestOrderBudgetSearchAttributesTranslatorInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RestOrderBudgetSearchAttributesTranslatorInterface $restOrderBudgetSearchAttributesTranslatorMock;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Builder\RestResponseBuilder
     */
    protected RestResponseBuilder $restResponseBuilder;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restOrderBudgetSearchAttributesMapperMock = $this->getMockBuilder(RestOrderBudgetSearchAttributesMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceBuilderMock = $this->getMockBuilder(RestResourceBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetListTransferMock = $this->getMockBuilder(OrderBudgetListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchAttributesTransferMock = $this->getMockBuilder(RestOrderBudgetSearchAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchPaginationTransferMock = $this->getMockBuilder(RestOrderBudgetSearchPaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResourceMock = $this->getMockBuilder(RestResourceInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseMock = $this->getMockBuilder(RestResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restOrderBudgetSearchAttributesTranslatorMock = $this->getMockBuilder(RestOrderBudgetSearchAttributesTranslatorInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilder = new RestResponseBuilder(
            $this->restOrderBudgetSearchAttributesTranslatorMock,
            $this->restOrderBudgetSearchAttributesMapperMock,
            $this->restResourceBuilderMock,
        );
    }

    /**
     * @return void
     */
    public function testBuildOrderBudgetSearchRestResponse(): void
    {
        $locale = 'de_DE';
        $numFound = 100;

        $this->restOrderBudgetSearchAttributesMapperMock->expects(static::atLeastOnce())
            ->method('fromOrderBudgetList')
            ->with($this->orderBudgetListTransferMock)
            ->willReturn($this->restOrderBudgetSearchAttributesTransferMock);

        $this->restOrderBudgetSearchAttributesTranslatorMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with($this->restOrderBudgetSearchAttributesTransferMock)
            ->willReturn($this->restOrderBudgetSearchAttributesTransferMock);

        $this->restOrderBudgetSearchAttributesTransferMock->expects(static::atLeastOnce())
            ->method('getPagination')
            ->willReturn($this->restOrderBudgetSearchPaginationTransferMock);

        $this->restOrderBudgetSearchPaginationTransferMock->expects(static::atLeastOnce())
            ->method('getNumFound')
            ->willReturn($numFound);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResponse')
            ->with($numFound)
            ->willReturn($this->restResponseMock);

        $this->restResourceBuilderMock->expects(static::atLeastOnce())
            ->method('createRestResource')
            ->with(
                OrderBudgetSearchRestApiConfig::RESOURCE_ORDER_BUDGET_SEARCH,
                null,
                $this->restOrderBudgetSearchAttributesTransferMock,
            )->willReturn($this->restResourceMock);

        $this->restResourceMock->expects(static::atLeastOnce())
            ->method('setPayload')
            ->with($this->orderBudgetListTransferMock)
            ->willReturn($this->restResourceMock);

        $this->restResponseMock->expects(static::atLeastOnce())
            ->method('addResource')
            ->with($this->restResourceMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->restResponseBuilder->buildOrderBudgetSearchRestResponse(
                $this->orderBudgetListTransferMock,
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
                        return $restErrorMessageTransfer->getCode() === OrderBudgetSearchRestApiConfig::RESPONSE_CODE_USER_IS_NOT_SPECIFIED
                            && $restErrorMessageTransfer->getDetail() === OrderBudgetSearchRestApiConfig::ERROR_MESSAGE_USER_IS_NOT_SPECIFIED
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
