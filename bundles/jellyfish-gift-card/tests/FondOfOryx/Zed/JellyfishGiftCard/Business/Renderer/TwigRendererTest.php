<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer;

use Codeception\Test\Unit;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Renderer\JellyfishGiftCardToRendererInterface;
use Generated\Shared\Transfer\LocaleTransfer;

class TwigRendererTest extends Unit
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Renderer\JellyfishGiftCardToRendererInterface|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $bridgeMock;

    /**
     * @var \Generated\Shared\Transfer\LocaleTransfer|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $localeTransferMock;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\TwigRenderer
     */
    protected $twigRender;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->bridgeMock = $this->getMockBuilder(JellyfishGiftCardToRendererInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->localeTransferMock = $this->getMockBuilder(LocaleTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->twigRender = new TwigRenderer($this->bridgeMock);
    }

    /**
     * @return void
     */
    public function testRender(): void
    {
        $template = 'foo.twig';
        $renderedTemplate = 'Foo bar!';
        $options = [];

        $this->bridgeMock->expects(static::atLeastOnce())
            ->method('setLocaleTransfer')
            ->with($this->localeTransferMock);

        $this->bridgeMock->expects(static::atLeastOnce())
            ->method('render')
            ->with($template, $options)
            ->willReturn($renderedTemplate);

        static::assertEquals(
            $renderedTemplate,
            $this->twigRender->render($template, $this->localeTransferMock, $options)
        );
    }
}
