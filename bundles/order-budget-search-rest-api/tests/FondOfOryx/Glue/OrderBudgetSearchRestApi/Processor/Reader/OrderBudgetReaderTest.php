<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Reader;

use Codeception\Test\Unit;
use FondOfOryx\Client\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiClientInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Builder\RestResponseBuilderInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface;
use FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\OrderBudgetListMapperInterface;
use Generated\Shared\Transfer\OrderBudgetListTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class OrderBudgetReaderTest extends Unit
{
    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Filter\CustomerReferenceFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|CustomerReferenceFilterInterface $customerReferenceFilterMock;

    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\OrderBudgetListMapperInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetListMapperInterface|MockObject $orderBudgetListMapperMock;

    /**
     * @var (\FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Builder\RestResponseBuilderInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected RestResponseBuilderInterface|MockObject $restResponseBuilderMock;

    /**
     * @var (\FondOfOryx\Client\OrderBudgetSearchRestApi\OrderBudgetSearchRestApiClientInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetSearchRestApiClientInterface|MockObject $clientMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\MetadataInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected MetadataInterface|MockObject $metadataMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\JsonApi\RestResponseInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestResponseInterface|MockObject $restResponseMock;

    /**
     * @var (\Generated\Shared\Transfer\OrderBudgetListTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected OrderBudgetListTransfer|MockObject $orderBudgetListTransferMock;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Reader\OrderBudgetReader
     */
    protected OrderBudgetReader $orderBudgetReader;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->customerReferenceFilterMock = $this->getMockBuilder(CustomerReferenceFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetListMapperMock = $this->getMockBuilder(OrderBudgetListMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restResponseBuilderMock = $this->getMockBuilder(RestResponseBuilderInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->clientMock = $this->getMockBuilder(OrderBudgetSearchRestApiClientInterface::class)
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

        $this->orderBudgetListTransferMock = $this->getMockBuilder(OrderBudgetListTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderBudgetReader = new OrderBudgetReader(
            $this->customerReferenceFilterMock,
            $this->orderBudgetListMapperMock,
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

        $this->customerReferenceFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($customerReference);

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildUseIsNotSpecifiedRestResponse');

        $this->orderBudgetListMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->orderBudgetListTransferMock);

        $this->clientMock->expects(static::atLeastOnce())
            ->method('findOrderBudgets')
            ->with($this->orderBudgetListTransferMock)
            ->willReturn($this->orderBudgetListTransferMock);

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getMetadata')
            ->willReturn($this->metadataMock);

        $this->metadataMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($locale);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildOrderBudgetSearchRestResponse')
            ->with($this->orderBudgetListTransferMock)
            ->willReturn($this->restResponseMock);

        static::assertEquals(
            $this->restResponseMock,
            $this->orderBudgetReader->find($this->restRequestMock),
        );
    }

    /**
     * @return void
     */
    public function testFindWithError(): void
    {
        $this->customerReferenceFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn(null);

        $this->restResponseBuilderMock->expects(static::atLeastOnce())
            ->method('buildUseIsNotSpecifiedRestResponse')
            ->willReturn($this->restResponseMock);

        $this->orderBudgetListMapperMock->expects(static::never())
            ->method('fromRestRequest');

        $this->clientMock->expects(static::never())
            ->method('findOrderBudgets');

        $this->restRequestMock->expects(static::never())
            ->method('getMetadata');

        $this->restResponseBuilderMock->expects(static::never())
            ->method('buildOrderBudgetSearchRestResponse');

        static::assertEquals(
            $this->restResponseMock,
            $this->orderBudgetReader->find($this->restRequestMock),
        );
    }
}
