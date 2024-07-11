<?php

namespace FondOfOryx\Zed\EasyApi;

use FondOfOryx\Shared\EasyApi\EasyApiConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class EasyApiConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getEasyApiUri(): string
    {
        return rtrim($this->get(EasyApiConstants::EASY_API_CLIENT_URI, ''));
    }

    /**
     * @return string
     */
    public function getEasyApiUser(): string
    {
        return $this->get(EasyApiConstants::EASY_API_CLIENT_USER, '');
    }

    /**
     * @return string
     */
    public function getEasyApiPassword(): string
    {
        return $this->get(EasyApiConstants::EASY_API_CLIENT_PASSWORD, '');
    }

    /**
     * @return array
     */
    public function getAllowedBodyFields(): array
    {
        return $this->get(EasyApiConstants::EASY_API_CLIENT_ALLOWED_BODY_FIELDS, EasyApiConstants::EASY_API_CLIENT_ALLOWED_BODY_FIELDS_DEFAULT);
    }

    /**
     * @return array
     */
    public function getJsonHeader(): array
    {
        $defaultHeaders = [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => sprintf('Basic %s', $this->getBase64Credentials()),
            ],
        ];

        return $this->get(EasyApiConstants::EASY_API_CLIENT_HEADER_JSON, $defaultHeaders);
    }

    /**
     * @return array
     */
    public function getOctetStreamHeader(): array
    {
        $defaultHeaders = [
            'headers' => [
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment',
                'Authorization' => sprintf('Basic %s', $this->getBase64Credentials()),
            ],
        ];

        return $this->get(EasyApiConstants::EASY_API_CLIENT_HEADER_STREAM, $defaultHeaders);
    }

    /**
     * @return string
     */
    public function getBase64Credentials(): string
    {
        return base64_encode(sprintf('%s:%s', $this->getEasyApiUser(), $this->getEasyApiPassword()));
    }
}
