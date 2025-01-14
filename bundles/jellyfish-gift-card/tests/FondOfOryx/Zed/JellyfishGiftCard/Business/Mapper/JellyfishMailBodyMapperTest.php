<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use Codeception\Test\Unit;
use Exception;
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
        $self = $this;

        $options = ['order' => [], 'gift-card' => [], 'locale' => []];
        $renderedPlainTextTemplate = 'Foo bar!';
        $renderedHtmlTemplate = '<h1>Foo bar!</h1>';

        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('getLocale')
            ->willReturn($this->localeTransferMock);

        $this->jellyfishGiftCardRequestTransferMock->expects(static::atLeastOnce())
            ->method('toArray')
            ->willReturn($options);

        $callCount = $this->atLeastOnce();
        $this->rendererMock->expects($callCount)
            ->method('render')
            ->willReturnCallback(static function (string $template, LocaleTransfer $localeTransfer, array $optionsFn = []) use ($self, $callCount, $options, $renderedPlainTextTemplate, $renderedHtmlTemplate) {
                /** @phpstan-ignore-next-line */
                if (method_exists($callCount, 'getInvocationCount')) {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->getInvocationCount();
                } else {
                    /** @phpstan-ignore-next-line */
                    $count = $callCount->numberOfInvocations();
                }

                switch ($count) {
                    case 1:
                        $self->assertSame(JellyfishGiftCardConstants::LAYOUT_TEMPLATE_MAIL_TEXT, $template);
                        $self->assertSame($self->localeTransferMock, $localeTransfer);
                        $self->assertSame($options, $optionsFn);

                        return $renderedPlainTextTemplate;
                    case 2:
                        $self->assertSame(JellyfishGiftCardConstants::LAYOUT_TEMPLATE_MAIL_HTML, $template);
                        $self->assertSame($self->localeTransferMock, $localeTransfer);
                        $self->assertSame($options, $optionsFn);

                        return $renderedHtmlTemplate;
                }

                throw new Exception('Unexpected call count');
            });

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
                ->fromJellyfishGiftCardRequest($this->jellyfishGiftCardRequestTransferMock),
        );
    }
}
