<?php

namespace FondOfOryx\Zed\OneTimePassword;

use FondOfOryx\Shared\OneTimePassword\OneTimePasswordConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class OneTimePasswordConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getLoginLinkPath(): string
    {
        return $this->get(
            OneTimePasswordConstants::ONE_TIME_PASSWORD_LOGIN_LINK_PATH,
            '/login',
        );
    }

    /**
     * @return string
     */
    public function getLoginLinkParameterName(): string
    {
        return $this->get(
            OneTimePasswordConstants::ONE_TIME_PASSWORD_LOGIN_LINK_PARAMETER_NAME,
            'signature',
        );
    }

    /**
     * @return string
     */
    public function getLoginLinkOrderReferenceName(): string
    {
        return $this->get(
            OneTimePasswordConstants::ONE_TIME_PASSWORD_LOGIN_LINK_ORDER_REFERENCE_NAME,
            'orderReference',
        );
    }

    /**
     * @return bool
     */
    public function getPasswordGeneratorUppercase(): bool
    {
        return $this->get(
            OneTimePasswordConstants::ONE_TIME_PASSWORD_GENERATE_PASSWORD_UPPERCASE,
            true,
        );
    }

    /**
     * @return bool
     */
    public function getPasswordGeneratorLowercase(): bool
    {
        return $this->get(
            OneTimePasswordConstants::ONE_TIME_PASSWORD_GENERATE_PASSWORD_LOWERCASE,
            true,
        );
    }

    /**
     * @return bool
     */
    public function getPasswordGeneratorNumbers(): bool
    {
        return $this->get(
            OneTimePasswordConstants::ONE_TIME_PASSWORD_GENERATE_PASSWORD_NUMBERS,
            true,
        );
    }

    /**
     * @return bool
     */
    public function getPasswordGeneratorSymbols(): bool
    {
        return $this->get(
            OneTimePasswordConstants::ONE_TIME_PASSWORD_GENERATE_PASSWORD_SYMBOLS,
            true,
        );
    }

    /**
     * @return int
     */
    public function getPasswordGeneratorSegmentLength(): int
    {
        return $this->get(
            OneTimePasswordConstants::ONE_TIME_PASSWORD_GENERATE_PASSWORD_SEGMENT_LENGTH,
            3,
        );
    }

    /**
     * @return int
     */
    public function getPasswordGeneratorSegmentCount(): int
    {
        return $this->get(
            OneTimePasswordConstants::ONE_TIME_PASSWORD_GENERATE_PASSWORD_SEGMENT_COUNT,
            4,
        );
    }

    /**
     * @return string
     */
    public function getPasswordGeneratorSegmentSeparator(): string
    {
        return $this->get(
            OneTimePasswordConstants::ONE_TIME_PASSWORD_GENERATE_PASSWORD_SEGMENT_SEPARATOR,
            '-',
        );
    }

    /**
     * @return string
     */
    public function getDefaultUrlLocale(): string
    {
        return $this->get(
            OneTimePasswordConstants::ONE_TIME_PASSWORD_DEFAULT_URL_LOCALE,
            'en',
        );
    }
}
