<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Expander;

use FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Reader\StoreReaderInterface;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\MailTransfer;

class MailExpander implements MailExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Reader\StoreReaderInterface
     */
    protected StoreReaderInterface $storeReader;

    /**
     * @param \FondOfOryx\Zed\FallbackLocaleMailProxy\Business\Reader\StoreReaderInterface $storeReader
     */
    public function __construct(StoreReaderInterface $storeReader)
    {
        $this->storeReader = $storeReader;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer): MailTransfer
    {
        $storeTransfer = $this->storeReader->getByMail($mailTransfer);
        $defaultLocaleIsoCode = $storeTransfer->getDefaultLocaleIsoCode();
        $localeTransfer = $mailTransfer->getLocale();

        if ($localeTransfer === null) {
            return $mailTransfer->setLocale(
                (new LocaleTransfer())->setLocaleName($defaultLocaleIsoCode),
            );
        }

        $availableLocaleIsoCodes = $storeTransfer->getAvailableLocaleIsoCodes();

        foreach ($availableLocaleIsoCodes as $availableLocaleIsoCode) {
            if ($localeTransfer->getLocaleName() !== $availableLocaleIsoCode) {
                continue;
            }

            return $mailTransfer;
        }

        return $mailTransfer->setLocale(
            (new LocaleTransfer())->setLocaleName($defaultLocaleIsoCode),
        );
    }
}
