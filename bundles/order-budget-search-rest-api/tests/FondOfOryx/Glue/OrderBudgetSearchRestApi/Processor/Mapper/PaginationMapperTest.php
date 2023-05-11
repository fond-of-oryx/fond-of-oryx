<?php

namespace FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use PHPUnit\Framework\MockObject\MockObject;
use Spryker\Glue\GlueApplication\Rest\Request\Data\PageInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class PaginationMapperTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected RestRequestInterface|MockObject $restRequestMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|(\Spryker\Glue\GlueApplication\Rest\Request\Data\PageInterface&\PHPUnit\Framework\MockObject\MockObject)
     */
    protected PageInterface|MockObject $pageMock;

    /**
     * @var \FondOfOryx\Glue\OrderBudgetSearchRestApi\Processor\Mapper\PaginationMapper
     */
    protected PaginationMapper $paginationMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->pageMock = $this->getMockBuilder(PageInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->paginationMapper = new PaginationMapper();
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $limit = 12;
        $offset = 0;
        $currentPage = 1;

        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getPage')
            ->willReturn($this->pageMock);

        $this->pageMock->expects(static::atLeastOnce())
            ->method('getLimit')
            ->willReturn($limit);

        $this->pageMock->expects(static::atLeastOnce())
            ->method('getOffset')
            ->willReturn($offset);

        $paginationTransfer = $this->paginationMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals(
            $limit,
            $paginationTransfer->getMaxPerPage(),
        );

        static::assertEquals(
            $currentPage,
            $paginationTransfer->getPage(),
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequestWithNullablePage(): void
    {
        $this->restRequestMock->expects(static::atLeastOnce())
            ->method('getPage')
            ->willReturn(null);

        $paginationTransfer = $this->paginationMapper->fromRestRequest($this->restRequestMock);

        static::assertEquals(
            null,
            $paginationTransfer->getMaxPerPage(),
        );

        static::assertEquals(
            null,
            $paginationTransfer->getPage(),
        );
    }
}
