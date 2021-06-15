<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer;
use Generated\Shared\Transfer\RestSplittableCheckoutRequestTransfer;

class RestSplittableCheckoutRequestMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\RestSplittableCheckoutRequestAttributesTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $restSplittableCheckoutRequestAttributesTransferMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutRequestMapper
     */
    protected $restSplittableCheckoutRequestMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->restSplittableCheckoutRequestAttributesTransferMock = $this->getMockBuilder(RestSplittableCheckoutRequestAttributesTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutRequestMapper = new RestSplittableCheckoutRequestMapper();
    }

    /**
     * @return void
     */
    public function testFromRestSplittableCheckoutRequestAttributes(): void
    {
        $this->restSplittableCheckoutRequestAttributesTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn([]);

        static::assertInstanceOf(
            RestSplittableCheckoutRequestTransfer::class,
            $this->restSplittableCheckoutRequestMapper->fromRestSplittableCheckoutRequestAttributes(
                $this->restSplittableCheckoutRequestAttributesTransferMock
            )
        );
    }
}
