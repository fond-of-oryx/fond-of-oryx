<?php

namespace FondOfOryx\Service\CrossEngage\Model\Url;

use FondOfOryx\Service\CrossEngage\CrossEngageConfig;
use FondOfOryx\Shared\CrossEngage\CrossEngageConstants;

class CrossEngageUrlBuilder implements CrossEngageUrlBuilderInterface
{
    /**
     * @var \FondOfOryx\Service\CrossEngage\CrossEngageConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Service\CrossEngage\CrossEngageConfig $config
     */
    public function __construct(CrossEngageConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function buildOptInUrl(array $params): string
    {
        return $this->buildUrl($params, $this->config->getOptInPathPattern());
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function buildOptOutUrl(array $params): string
    {
        return $this->buildUrl($params, $this->config->getOptoutPathPattern());
    }

    /**
     * @param array $params
     * @param bool $external
     *
     * @return string
     */
    public function buildRedirectUrl(array $params, bool $external): string
    {
        $queryString = null;
        if (array_key_exists(CrossEngageConstants::QUERY_STRING, $params)) {
            $queryString = $params[CrossEngageConstants::QUERY_STRING];
            unset($params[CrossEngageConstants::QUERY_STRING]);
        }

        if ($external === false) {
            return $this->buildInternalUrl($params, $this->config->getCrossEngageRedirectPattern(), $queryString);
        }

        return $this->buildUrl($params, $this->config->getCrossEngageRedirectPattern(), $queryString);
    }

    /**
     * @param array $params
     * @param string $pattern
     * @param string|null $queryString
     *
     * @return string
     */
    protected function buildUrl(array $params, string $pattern, ?string $queryString = null): string
    {
        return $this->appendQueryString($this->config->getHostYves() . '/' . vsprintf($pattern, $params), $queryString);
    }

    /**
     * @param array $params
     * @param string $pattern
     * @param string|null $queryString
     *
     * @return string
     */
    protected function buildInternalUrl(array $params, string $pattern, ?string $queryString = null): string
    {
        return $this->appendQueryString(sprintf('/%s', vsprintf($pattern, $params)), $queryString);
    }

    /**
     * @param string $path
     * @param string|null $queryString
     *
     * @return string
     */
    protected function appendQueryString(string $path, ?string $queryString = null): string
    {
        if (empty($queryString) === true) {
            return $path;
        }

        return sprintf('%s?%s', $path, $queryString);
    }

    /**
     * @return string
     */
    public function getNameParam(): string
    {
        return CrossEngageConstants::CROSSENGAGE;
    }

    /**
     * @return string
     */
    public function getTokenParam(): string
    {
        return CrossEngageConstants::TOKEN;
    }
}
