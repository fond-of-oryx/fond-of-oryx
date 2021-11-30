<?php

namespace FondOfOryx\Service\Trbo\Api;

use FondOfOryx\Service\Trbo\TrboConfig;
use FondOfOryx\Shared\Trbo\TrboConstants;
use Symfony\Component\HttpFoundation\Request;

class TrboApiConfiguration implements TrboApiConfigurationInterface
{
    /**
     * @var \FondOfOryx\Service\Trbo\TrboConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Service\Trbo\TrboConfig $config
     */
    public function __construct(TrboConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    public function getConfiguration(Request $request): array
    {
        return array_merge($this->getTimeout(), $this->getHeaderData(), $this->getBodyData($request));
    }

    /**
     * @return string
     */
    public function getApiUrl(): string
    {
        return $this->config->getTrboApiUrl();
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return array
     */
    protected function getBodyData(Request $request): array
    {
        return [
            'json' => [
                'globals' => [
                    'userId' => $this->getTrboUserIdFromCookie($request),
                    'ip' => $request->getClientIp(),
                    'location' => $request->getHttpHost() . $request->getPathInfo(),
                    'referrer' => $request->headers->get('referer'),
                ],
                'datalayer' => [
                    'requestOrigin' => 'serverside',
                ],
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getHeaderData(): array
    {
        return [
            'headers' => [
                TrboConstants::TRBO_API_HEADER_PARAM_SHOPID => $this->config->getTrboApiShopId(),
                TrboConstants::TRBO_API_HEADER_PARAM_CLIENTID => $this->config->getTrboApiClientId(),
                TrboConstants::TRBO_API_HEADER_PARAM_APIKEY => $this->config->getTrboApiKey(),
            ],
        ];
    }

    /**
     * @return array
     */
    protected function getTimeout(): array
    {
        return ['timeout' => $this->config->getTrboApiTimeout()];
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return string
     */
    protected function getTrboUserIdFromCookie(Request $request): string
    {
        $trboUserId = $request->cookies->get(TrboConstants::TRBO_COOKIE_USERID);

        if ($trboUserId === null) {
            $trboUserId = md5(uniqid('trbo', false));
            $request->cookies->set(TrboConstants::TRBO_COOKIE_USERID, $trboUserId);
        }

        return $trboUserId;
    }
}
