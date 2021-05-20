<?php

namespace FondOfOryx\Zed\ReturnLabel;

use FondOfOryx\Shared\ReturnLabel\ReturnLabelConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class ReturnLabelConfig extends AbstractBundleConfig
{
    /**
     * @return string|null
     */
    public function getApiBaseUri(): ?string
    {
        $apiBaseUri = $this->get(ReturnLabelConstants::API_BASE_URI, '');

        if ($apiBaseUri === '') {
            return null;
        }

        return $apiBaseUri;
    }

    /**
     * @return string|null
     */
    public function getApiUsername(): ?string
    {
        $apiUsername = $this->get(ReturnLabelConstants::API_USERNAME, '');

        if ($apiUsername === '') {
            return null;
        }

        return $apiUsername;
    }

    /**
     * @return string|null
     */
    public function getApiPassword(): ?string
    {
        $apiPassword = $this->get(ReturnLabelConstants::API_PASSWORD, '');

        if ($apiPassword === '') {
            return null;
        }

        return $apiPassword;
    }

    /**
     * @return bool
     */
    public function appendReturnForm(): bool
    {
        return $this->get(ReturnLabelConstants::APPEND_RETURN_FORM, true);
    }

    /**
     * @return bool
     */
    public function printQrCodeOnReturnForm(): bool
    {
        return $this->get(ReturnLabelConstants::PRINT_QR_CODE_ON_RETURN_FORM, true);
    }

    /**
     * @return int
     */
    public function getApiRequestTimeout(): int
    {
        return $this->get(ReturnLabelConstants::API_REQUEST_TIMEOUT, 4);
    }

    /**
     * @return array
     */
    public function getApiRequestHeader(): array
    {
        return $this->get(ReturnLabelConstants::API_REQUEST_HEADER, [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);
    }
}
