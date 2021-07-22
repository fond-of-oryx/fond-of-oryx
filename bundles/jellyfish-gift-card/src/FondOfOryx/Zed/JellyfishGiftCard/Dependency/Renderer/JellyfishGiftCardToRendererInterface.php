<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Dependency\Renderer;

use Generated\Shared\Transfer\LocaleTransfer;

interface JellyfishGiftCardToRendererInterface
{
    /**
     * @param string $template
     * @param array $options
     *
     * @return string
     */
    public function render(string $template, array $options): string;

    /**
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return void
     */
    public function setLocaleTransfer(LocaleTransfer $localeTransfer): void;
}
