<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Codeception\Test\Unit;
use FondOfOryx\Shared\JellyfishGiftCard\JellyfishGiftCardConstants;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\RendererInterface;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Generated\Shared\Transfer\LocaleTransfer;

class JellyfishMailBodyMapperTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\RendererInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $rendererMock;

    /**
     * @var \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $jellyfishGiftCardRequestTransferMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailBodyMapper
     */
    protected $jellyfishMailBodyMapper;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->rendererMock = $this->getMockBuilder(RendererInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishGiftCardRequestTransferMock = $this->getMockBuilder(JellyfishGiftCardRequestTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->jellyfishMailBodyMapper = new JellyfishMailBodyMapper($this->rendererMock);
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequest(): void
    {
        $options = ['order' => [], 'gift-card' => [], 'locale' => []];
        $renderedPlainTextTemplate = 'Foo bar!';
        $renderedHtmlTemplate = '<h1>Foo bar!</h1>';

        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($options);

        $this->rendererMock->expects(static::atLeastOnce())
            ->method('render')
            ->withConsecutive(
                [
                    JellyfishGiftCardConstants::LAYOUT_TEMPLATE_MAIL_TEXT,
                    $this->localeTransferMock,
                    $options,
                ],
                [
                     JellyfishGiftCardConstants::LAYOUT_TEMPLATE_MAIL_HTML,
                     $this->localeTransferMock,
                     $options,
                 ]
            )->willReturnOnConsecutiveCalls(
                $renderedPlainTextTemplate,
                $renderedHtmlTemplate
            );

        $jellyfishMailBodyTransfer = $this->jellyfishMailBodyMapper
            ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock);

        static::assertNotEquals(null, $jellyfishMailBodyTransfer);
        static::assertEquals($renderedPlainTextTemplate, $jellyfishMailBodyTransfer->getPlainText());
        static::assertEquals($renderedHtmlTemplate, $jellyfishMailBodyTransfer->getHtml());
    }

    /**
     * @return void
     */
    public function testFromJellyfishGiftCardRequestWithoutLocale(): void
    {
        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn(null);

        $this->jellyfishGiftCardRequestTransferMock->expects(static::never())
            ->method('toArray');

        $this->rendererMock->expects(static::never())
            ->method('render');

        static::assertEquals(
            null,
            $this->jellyfishMailBodyMapper
                ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock)
        );
    }
}
