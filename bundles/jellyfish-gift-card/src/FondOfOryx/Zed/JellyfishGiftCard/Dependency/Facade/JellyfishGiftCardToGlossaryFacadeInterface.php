<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade;

use Generated\Shared\Transfer\LocaleTransfer;

interface JellyfishGiftCardToGlossaryFacadeInterface
{
    /**
     * @param string $keyName
     * @param array $data
     * @param \Generated\Shared\Transfer\LocaleTransfer|null $localeTransfer
     *
     * @throws \Spryker\Zed\Glossary\Business\Exception\MissingTranslationException
     *
     * @return string
     */
    public function translate(string $keyName, array $data = [], ?LocaleTransfer $localeTransfer = null): string;
}
