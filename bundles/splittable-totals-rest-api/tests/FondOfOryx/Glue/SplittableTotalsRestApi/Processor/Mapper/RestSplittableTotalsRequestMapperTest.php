<?php

namespace FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableTotalsRequestTransfer;

class RestSplittableTotalsRequestMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestSplittableTotalsRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableTotalsRequestAttributesTransferMock;

    /**
     * @var \FondOfOryx\Glue\SplittableTotalsRestApi\Processor\Mapper\RestSplittableTotalsRequestMapper
     */
    protected $restSplittableTotalsRequestMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restSplittableTotalsRequestAttributesTransferMock = $this->getMockBuilder(RestSplittableTotalsRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableTotalsRequestMapper = new RestSplittableTotalsRequestMapper();
    }

    /**
     * @return void
     */
    public function testFromRestSplittableTotalsRequestAttributes(): void
    {
        $this->restSplittableTotalsRequestAttributesTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        static::assertInstanceOf(
            RestSplittableTotalsRequestTransfer::class,
            $this->restSplittableTotalsRequestMapper->fromRestSplittableTotalsRequestAttributes(
                $this->restSplittableTotalsRequestAttributesTransferMock
            )
        );
    }
}
