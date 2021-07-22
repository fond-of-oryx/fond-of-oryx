<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer;

use Generated\Shared\Transfer\LocaleTransfer;

interface RendererInterface
{
    /**
     * @param string $template
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     * @param array $options
     *
     * @return string
     */
    public function render(string $template, LocaleTransfer $localeTransfer, array $options = []): string;
}
