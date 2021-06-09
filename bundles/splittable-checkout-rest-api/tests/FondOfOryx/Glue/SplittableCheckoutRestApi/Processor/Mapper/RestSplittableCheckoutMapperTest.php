<?php

namespace FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\SplittableCheckoutTransfer;

class RestSplittableCheckoutMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\SplittableCheckoutTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutTransferMock;

    /**
     * @var \FondOfOryx\Glue\SplittableCheckoutRestApi\Processor\Mapper\RestSplittableCheckoutMapper
     */
    protected $restSplittableCheckoutMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableCheckoutTransferMock = $this->getMockBuilder(SplittableCheckoutTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->restSplittableCheckoutMapper = new RestSplittableCheckoutMapper();
    }

    /**
     * @return void
     */
    public function testFromSplittableCheckout(): void
    {
        $orderReferences = ['FOO-1', 'FOO-2'];

        $this->splittableCheckoutTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn(['order_references' => $orderReferences]);

        $restSplittableCheckoutTransfer = $this->restSplittableCheckoutMapper
            ->fromSplittableCheckout($this->splittableCheckoutTransferMock);

        static::assertEquals($orderReferences, $restSplittableCheckoutTransfer->getOrderReferences());
    }
}
