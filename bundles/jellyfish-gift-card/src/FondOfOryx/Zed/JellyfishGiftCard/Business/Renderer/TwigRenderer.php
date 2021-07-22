<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer;

use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Renderer\JellyfishGiftCardToRendererInterface;
use Generated\Shared\Transfer\LocaleTransfer;

class TwigRenderer implements RendererInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Renderer\JellyfishGiftCardToRendererInterface
     */
    protected $renderer;

    /**
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Renderer\JellyfishGiftCardToRendererInterface $renderer
     */
    public function __construct(JellyfishGiftCardToRendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param string $template
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param array $options
     *
     * @return string
     */
    public function render(string $template, LocaleTransfer $localeTransfer, array $options = []): string
    {
        $this->renderer->setLocaleTransfer($localeTransfer);

        return $this->renderer->render($template, $options);
    }
}
