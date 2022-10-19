<?php

namespace FondOfOryx\Glue\ProductListSearchRestApi\Processor\Mapper;

use ArrayObject;
use Codeception\Test\Unit;
use FondOfOryx\Glue\ProductListSearchRestApi\Processor\Expander\FilterFieldsExpanderInterface;
use Generated\Shared\Transfer\FilterFieldTransfer;
use Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface;

class FilterFieldsMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Glue\ProductListSearchRestApi\Processor\Expander\FilterFieldsExpanderInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterFieldsExpanderMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Glue\GlueApplication\Rest\Request\Data\RestRequestInterface
     */
    protected $restRequestMock;

    /**
     * @var \Generated\Shared\Transfer\FilterFieldTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $filterFieldTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->filterFieldsExpanderMock = $this->getMockBuilder(FilterFieldsExpanderInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->restRequestMock = $this->getMockBuilder(RestRequestInterface::class)
                ->disableOriginalConstructor()
                ->getMock();

        $this->filterFieldTransferMock = $this->getMockBuilder(FilterFieldTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->filterFieldsMapper = new FilterFieldsMapper(
            $this->filterFieldsExpanderMock,
        );
    }

    /**
     * @return void
     */
    public function testFromRestRequest(): void
    {
        $this->filterFieldsExpanderMock->expects(static::atLeastOnce())
            ->method('expand')
            ->with($this->restRequestMock)
            ->willReturn(new ArrayObject());

        static::assertInstanceOf(
            ArrayObject::class,
            $this->filterFieldsMapper->fromRestRequest($this->restRequestMock),
        );
    }
}
