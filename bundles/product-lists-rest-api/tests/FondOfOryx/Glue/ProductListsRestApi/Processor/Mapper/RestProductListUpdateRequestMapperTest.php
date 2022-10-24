<?php

namespace FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdProductListFilterInterface;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class RestProductListUpdateRequestMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Filter\IdProductListFilterInterface&\PHPUnit\Framework\MockObject\MockObject|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $idProductListFilterMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface&\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restRequestMock;

    /**
     * @var \FondOfOryx\Glue\ProductListsRestApi\Processor\Mapper\RestProductListUpdateRequestMapper
     */
    protected $restProductListUpdateRequestMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->idProductListFilterMock = $this->getMockBuilder(IdProductListFilterInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restProductListUpdateRequestMapper = new RestProductListUpdateRequestMapper(
            $this->idProductListFilterMock,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $uuid = 'd6443d3e-f879-492e-85fb-caa8059db684';

        $this->idProductListFilterMock->expects(static::atLeastOnce())
            ->method('filterFromRestRequest')
            ->with($this->restRequestMock)
            ->willReturn($uuid);

        $restProductListUpdateRequestTransfer = $this->restProductListUpdateRequestMapper->fromRestRequest(
            $this->restRequestMock,
        );

        static::assertEquals(
            $uuid,
            $restProductListUpdateRequestTransfer->getProductListId(),
        );
    }
}
