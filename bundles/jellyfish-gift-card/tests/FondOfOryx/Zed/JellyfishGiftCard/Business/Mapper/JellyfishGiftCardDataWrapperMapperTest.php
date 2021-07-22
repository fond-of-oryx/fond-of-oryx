<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishGiftCardDataTransfer;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;

class JellyfishGiftCardDataWrapperMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardDataMapperMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataWrapperMapper
     */
    protected $jellyfishGiftCardDataWrapperMapper;

    /**
     * @var \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishGiftCardDataTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardDataTransferMock;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishGiftCardDataMapperMock = $this->getMockBuilder(JellyfishGiftCardDataMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardRequestTransferMock = $this->getMockBuilder(JellyfishGiftCardRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardDataTransferMock = $this->getMockBuilder(JellyfishGiftCardDataTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardDataWrapperMapper = new JellyfishGiftCardDataWrapperMapper(
            $this->jellyfishGiftCardDataMapperMock
        );
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequest(): void
    {
        $this->jellyfishGiftCardDataMapperMock->expects(static::atLeastOnce())
            ->method('fromJellyfishGiftCardRequest')
            ->with($this->jellyfishGiftCardRequestTransferMock)
            ->willReturn($this->jellyfishGiftCardDataTransferMock);

        $jellyfishGiftCardDataWrapperTransfer = $this->jellyfishGiftCardDataWrapperMapper
            ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock);

        static::assertEquals(
            $this->jellyfishGiftCardDataTransferMock,
            $jellyfishGiftCardDataWrapperTransfer->getData()
        );
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequestWithError(): void
    {
        $this->jellyfishGiftCardDataMapperMock->expects(static::atLeastOnce())
            ->method('fromJellyfishGiftCardRequest')
            ->with($this->jellyfishGiftCardRequestTransferMock)
            ->willReturn(null);

        static::assertEquals(
            null,
            $this->jellyfishGiftCardDataWrapperMapper
                ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock)
        );
    }
}
