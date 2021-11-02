<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Shared\JellyfishGiftCard\JellyfishGiftCardConstants;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGlossaryFacadeInterface;
use FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Generated\Shared\Transfer\JellyfishMailBodyTransfer;
use Generated\Shared\Transfer\JellyfishMailRecipientTransfer;
use Generated\Shared\Transfer\LocaleTransfer;

class JellyfishMailMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailRecipientMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishMailRecipientMapperMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailBodyMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishMailBodyMapperMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $configMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGlossaryFacadeInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $glossaryFacadeMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishMailRecipientTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishMailRecipientTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishMailBodyTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishMailBodyTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailMapper
     */
    protected $jellyfishMailMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishMailRecipientMapperMock = $this->getMockBuilder(JellyfishMailRecipientMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishMailBodyMapperMock = $this->getMockBuilder(JellyfishMailBodyMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(JellyfishGiftCardConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->glossaryFacadeMock = $this->getMockBuilder(JellyfishGiftCardToGlossaryFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardRequestTransferMock = $this->getMockBuilder(JellyfishGiftCardRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishMailRecipientTransferMock = $this->getMockBuilder(JellyfishMailRecipientTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishMailBodyTransferMock = $this->getMockBuilder(JellyfishMailBodyTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishMailMapper = new JellyfishMailMapper(
            $this->jellyfishMailRecipientMapperMock,
            $this->jellyfishMailBodyMapperMock,
            $this->configMock,
            $this->glossaryFacadeMock,
        );
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequest(): void
    {
        $senderName = 'John Doe';
        $senderEmail = 'john.doe@example.com';
        $subject = 'Foo';

        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->jellyfishMailRecipientMapperMock->expects(static::atLeastOnce())
            ->method('fromJellyfishGiftCardRequest')
            ->with($this->jellyfishGiftCardRequestTransferMock)
            ->willReturn($this->jellyfishMailRecipientTransferMock);

        $this->jellyfishMailBodyMapperMock->expects(static::atLeastOnce())
            ->method('fromJellyfishGiftCardRequest')
            ->with($this->jellyfishGiftCardRequestTransferMock)
            ->willReturn($this->jellyfishMailBodyTransferMock);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSenderName')
            ->willReturn($senderName);

        $this->configMock->expects(static::atLeastOnce())
            ->method('getSenderEmail')
            ->willReturn($senderEmail);

        $this->glossaryFacadeMock->expects(static::atLeastOnce())
            ->method('translate')
            ->with(JellyfishGiftCardConstants::SUBJECT, [], $this->localeTransferMock)
            ->willReturn($subject);

        $jellyfishMailTransfer = $this->jellyfishMailMapper
            ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock);

        static::assertNotEquals(null, $jellyfishMailTransfer);
        static::assertEquals($this->jellyfishMailRecipientTransferMock, $jellyfishMailTransfer->getRecipient());
        static::assertNotEquals(null, $jellyfishMailTransfer->getSender());
        static::assertEquals($senderName, $jellyfishMailTransfer->getSender()->getName());
        static::assertEquals($senderEmail, $jellyfishMailTransfer->getSender()->getEmail());
        static::assertEquals($subject, $jellyfishMailTransfer->getSubject());
        static::assertEquals($this->jellyfishMailBodyTransferMock, $jellyfishMailTransfer->getBody());
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequestWithoutLocale(): void
    {
        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn(null);

        $this->jellyfishMailRecipientMapperMock->expects(static::never())
            ->method('fromJellyfishGiftCardRequest');

        $this->jellyfishMailBodyMapperMock->expects(static::never())
            ->method('fromJellyfishGiftCardRequest');

        $this->configMock->expects(static::never())
            ->method('getSenderName');

        $this->configMock->expects(static::never())
            ->method('getSenderEmail');

        $this->glossaryFacadeMock->expects(static::never())
            ->method('translate');

        static::assertEquals(
            null,
            $this->jellyfishMailMapper
                ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock),
        );
    }
}
