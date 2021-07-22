<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class JellyfishMailRecipientMapperTest extends Unit
{
    /**
     * @var \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailRecipientMapper
     */
    protected $jellyfishMailRecipientMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishGiftCardRequestTransferMock = $this->getMockBuilder(JellyfishGiftCardRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishMailRecipientMapper = new JellyfishMailRecipientMapper();
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequest(): void
    {
        $firstName = 'John';
        $lastName = 'Doe';
        $email = 'john.doe@example.com';

        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getOrder')
            ->willReturn($this->orderTransferMock);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getFirstName')
            ->willReturn($firstName);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getLastName')
            ->willReturn($lastName);

        $this->orderTransferMock->expects(static::atLeastOnce())
            ->method('getEmail')
            ->willReturn($email);

        $jellyfishMailTransfer = $this->jellyfishMailRecipientMapper
            ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock);

        static::assertNotEquals(null, $jellyfishMailTransfer);
        static::assertEquals($firstName, $jellyfishMailTransfer->getFirstname());
        static::assertEquals($lastName, $jellyfishMailTransfer->getLastname());
        static::assertEquals($email, $jellyfishMailTransfer->getEmail());
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequestWithoutOrder(): void
    {
        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getOrder')
            ->willReturn(null);

        static::assertEquals(
            null,
            $this->jellyfishMailRecipientMapper
                ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock)
        );
    }
}
