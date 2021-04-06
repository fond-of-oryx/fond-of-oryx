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
}
