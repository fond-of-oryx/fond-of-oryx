<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Generated\Shared\Transfer\JellyfishGiftCardTransfer;

class JellyfishGiftCardDataMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardMapperMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishGiftCardTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataMapper
     */
    protected $jellyfishGiftCardDataMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishGiftCardMapperMock = $this->getMockBuilder(JellyfishGiftCardMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardRequestTransferMock = $this->getMockBuilder(JellyfishGiftCardRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardTransferMock = $this->getMockBuilder(JellyfishGiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardDataMapper = new JellyfishGiftCardDataMapper($this->jellyfishGiftCardMapperMock);
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequest(): void
    {
        $this->jellyfishGiftCardMapperMock->expects(static::atLeastOnce())
            ->method('fromJellyfishGiftCardRequest')
            ->with($this->jellyfishGiftCardRequestTransferMock)
            ->willReturn($this->jellyfishGiftCardTransferMock);

        $jellyfishGiftCardDataTransfer = $this->jellyfishGiftCardDataMapper
            ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock);

        static::assertEquals(
            $this->jellyfishGiftCardTransferMock,
            $jellyfishGiftCardDataTransfer->getAttributes()
        );
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequestWithError(): void
    {
        $this->jellyfishGiftCardMapperMock->expects(static::atLeastOnce())
            ->method('fromJellyfishGiftCardRequest')
            ->with($this->jellyfishGiftCardRequestTransferMock)
            ->willReturn(null);

        static::assertEquals(
            null,
            $this->jellyfishGiftCardDataMapper
                ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock)
        );
    }
}
