<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Shared\JellyfishGiftCard\JellyfishGiftCardConstants;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\RendererInterface;
use Generated\Shared\Transfer\GiftCardTransfer;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Generated\Shared\Transfer\JellyfishMailTransfer;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class JellyfishGiftCardMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailMapperInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishMailMapperMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\RendererInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $rendererMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\GiftCardTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $giftCardTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $orderTransferMock;

    /**
     * @var \Generated\Shared\Transfer\OrderTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishMailTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishMailTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardMapper
     */
    protected $jellyfishGiftCardMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->jellyfishMailMapperMock = $this->getMockBuilder(JellyfishMailMapperInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->rendererMock = $this->getMockBuilder(RendererInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardRequestTransferMock = $this->getMockBuilder(JellyfishGiftCardRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->giftCardTransferMock = $this->getMockBuilder(GiftCardTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->orderTransferMock = $this->getMockBuilder(OrderTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishMailTransferMock = $this->getMockBuilder(JellyfishMailTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardMapper = new JellyfishGiftCardMapper(
            $this->jellyfishMailMapperMock,
            $this->rendererMock
        );
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequest(): void
    {
        $code = 'FOO-BAR-123-456';
        $actualValue = 10000;
        $renderedTemplate = 'Foo bar!';
        $options = ['order' => [], 'gift-card' => [], 'local' => []];

        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getGiftCard')
            ->willReturn($this->giftCardTransferMock);

        $this->jellyfishMailMapperMock->expects(static::atLeastOnce())
            ->method('fromJellyfishGiftCardRequest')
            ->with($this->jellyfishGiftCardRequestTransferMock)
            ->willReturn($this->jellyfishMailTransferMock);

        $this->giftCardTransferMock->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn($code);

        $this->giftCardTransferMock->expects(static::atLeastOnce())
            ->method('getActualValue')
            ->willReturn($actualValue);

        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($options);

        $this->rendererMock->expects(static::atLeastOnce())
            ->method('render')
            ->with(
                JellyfishGiftCardConstants::LAYOUT_TEMPLATE_GIFT_CARD_HTML,
                $this->localeTransferMock,
                $options
            )->willReturn($renderedTemplate);

        $jellyfishGiftCardTransfer = $this->jellyfishGiftCardMapper
            ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock);

        static::assertNotEquals(null, $jellyfishGiftCardTransfer);
        static::assertEquals($actualValue / 100, $jellyfishGiftCardTransfer->getAmount());
        static::assertEquals($renderedTemplate, $jellyfishGiftCardTransfer->getTemplate());
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequestWithoutGiftCard(): void
    {
        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getGiftCard')
            ->willReturn(null);

        $this->jellyfishMailMapperMock->expects(static::never())
            ->method('fromJellyfishGiftCardRequest');

        $this->jellyfishGiftCardRequestTransferMock->expects(static::never())
            ->method('getLocale');

        $this->jellyfishGiftCardRequestTransferMock->expects(static::never())
            ->method('toArray');

        $this->rendererMock->expects(static::never())
            ->method('render');

        $jellyfishGiftCardTransfer = $this->jellyfishGiftCardMapper
            ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock);

        static::assertEquals(null, $jellyfishGiftCardTransfer);
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequestWithoutLocale(): void
    {
        $code = 'FOO-BAR-123-456';
        $actualValue = 10000;

        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getGiftCard')
            ->willReturn($this->giftCardTransferMock);

        $this->jellyfishMailMapperMock->expects(static::atLeastOnce())
            ->method('fromJellyfishGiftCardRequest')
            ->with($this->jellyfishGiftCardRequestTransferMock)
            ->willReturn($this->jellyfishMailTransferMock);

        $this->giftCardTransferMock->expects(static::atLeastOnce())
            ->method('getCode')
            ->willReturn($code);

        $this->giftCardTransferMock->expects(static::atLeastOnce())
            ->method('getActualValue')
            ->willReturn($actualValue);

        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn(null);

        $this->jellyfishGiftCardRequestTransferMock->expects(static::never())
            ->method('toArray');

        $this->rendererMock->expects(static::never())
            ->method('render');

        $jellyfishGiftCardTransfer = $this->jellyfishGiftCardMapper
            ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock);

        static::assertNotEquals(null, $jellyfishGiftCardTransfer);
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequestWithoutJellyfishMailTransfer(): void
    {
        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getGiftCard')
            ->willReturn($this->giftCardTransferMock);

        $this->jellyfishMailMapperMock->expects(static::atLeastOnce())
            ->method('fromJellyfishGiftCardRequest')
            ->with($this->jellyfishGiftCardRequestTransferMock)
            ->willReturn(null);

        $this->giftCardTransferMock->expects(static::never())
            ->method('getCode');

        $this->giftCardTransferMock->expects(static::never())
            ->method('getActualValue');

        $this->jellyfishGiftCardRequestTransferMock->expects(static::never())
            ->method('getLocale');

        $this->jellyfishGiftCardRequestTransferMock->expects(static::never())
            ->method('toArray');

        $this->rendererMock->expects(static::never())
            ->method('render');

        $jellyfishGiftCardTransfer = $this->jellyfishGiftCardMapper
            ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock);

        static::assertEquals(null, $jellyfishGiftCardTransfer);
    }
}
