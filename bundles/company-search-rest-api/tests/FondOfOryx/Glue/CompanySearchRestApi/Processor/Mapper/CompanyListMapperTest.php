<?php

namespace FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface;
use Generated\Shared\Transfer\PaginationTransfer;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class CompanyListMapperTest extends Unit
{
    /**
     * @var (\FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\PaginationMapperInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected PaginationMapperInterface|MockObject $paginationMapperMock;

    /**
     * @var (\FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\FilterFieldsMapperInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|FilterFieldsMapperInterface $filterFieldsMapperMock;

    /**
     * @var (\FondOfOryx\Glue\CompanySearchRestApi\Processor\Filter\RequestParameterFilterInterface&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|RequestParameterFilterInterface $requestParameterFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var (\Generated\Shared\Transfer\PaginationTransfer&\PHPUnit\Framework\MockObject\MockObject)|\PHPUnit\Framework\MockObject\MockObject
     */
    protected MockObject|PaginationTransfer $paginationTransferMock;

    /**
     * @var \FondOfOryx\Glue\CompanySearchRestApi\Processor\Mapper\CompanyListMapper
     */
    protected CompanyListMapper $companyListMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->paginationMapperMock = $this->getMockBuilder(PaginationMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldsMapperMock = $this->getMockBuilder(FilterFieldsMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->requestParameterFilterMock = $this->getMockBuilder(RequestParameterFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paginationTransferMock = $this->getMockBuilder(PaginationTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->companyListMapper = new CompanyListMapper(
            $this->paginationMapperMock,
            $this->filterFieldsMapperMock,
            $this->requestParameterFilterMock,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $companyUuid = 'e5046482-92ba-4c21-a239-db9ce1bc3c60';
        $query = 'foo';
        $sort = 'foo_asc';

        $this->paginationMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($this->paginationTransferMock);

        $this->filterFieldsMapperMock->expects(static::atLeastOnce())
            ->method('fromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn(new ArrayObject());

        $this->requestParameterFilterMock->expects(static::atLeastOnce())
            ->method('getRequestParameter')
            ->withConsecutive(
                [$this->restRequestMock, 'sort'],
                [$this->restRequestMock, 'id'],
            )->willReturnOnConsecutiveCalls(
                $sort,
                $companyUuid,
            );

        $companyListTransfer = $this->companyListMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals(
            $sort,
            $companyListTransfer->getSort(),
        );

        static::assertEquals(
            $this->paginationTransferMock,
            $companyListTransfer->getPagination(),
        );
    }
}
