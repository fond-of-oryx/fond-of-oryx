<?php

namespace FondOfOryx\Shared\NotionProxyRestApi;

use Spryker\Shared\Kernel\AbstractSharedConfig;

class NotionProxyRestApiConfig extends AbstractSharedConfig
{
    /**
     * @var string
     */
    public const HEADER_AUTHORIZATION = 'Authorization';

    /**
     * @var string
     */
    public const HEADER_NOTION_VERSION = 'Notion-Version';

    /**
     * @var string
     */
    public const HEADER_CONTENT_TYPE = 'Content-Type';

    /**
     * @var string
     */
    public const CONFIG_BASE_URI = 'base_uri';

    /**
     * @var string
     */
    public const CONFIG_HEADERS = 'headers';

    /**
     * @api
     *
     * @return array<string, mixed>
     */
    public function getClientConfig(): array
    {
        $config = [];
        $authHeader = (string)$this->get(NotionProxyRestApiConstants::AUTH_HEADER, '');
        $notionVersionHeader = (string)$this->get(NotionProxyRestApiConstants::NOTION_VERSION_HEADER, '');
        $baseUri = (string)$this->get(NotionProxyRestApiConstants::BASE_URI, '');

        if ($baseUri !== '') {
            $config[static::CONFIG_BASE_URI] = $baseUri;
        }

        $config[static::CONFIG_HEADERS] = [
            static::HEADER_AUTHORIZATION => sprintf('Bearer %s', $authHeader),
            static::HEADER_NOTION_VERSION => $notionVersionHeader,
            static::HEADER_CONTENT_TYPE => 'application/json',
        ];

        return $config;
    }
}
