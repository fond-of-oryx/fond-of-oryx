<?php

namespace FondOfOryx\Zed\CustomerRegistration;

use Generated\Shared\Transfer\SequenceNumberSettingsTransfer;

interface CustomerRegistrationConfigInterface
{
    /**
     * @api
     *
     * @param string $storeName
     *
     * @return \Generated\Shared\Transfer\SequenceNumberSettingsTransfer
     */
    public function getCustomerReferenceDefaults(string $storeName): SequenceNumberSettingsTransfer;

    /**
     * @return string
     */
    public function getVerificationLinkPattern(): string;

    /**
     * @return string
     */
    public function getFallbackUrlLanguageKey(): string;

    /**
     * @return string
     */
    public function getBaseUrl(): string;
}
