<?php

namespace FondOfOryx\Service\CrossEngage\Model\Url;

interface CrossEngageUrlBuilderInterface
{
    /**
     * @param array $params
     *
     * @return string
     */
    public function buildOptInUrl(array $params): string;

    /**
     * @param array $params
     *
     * @return string
     */
    public function buildOptOutUrl(array $params): string;

    /**
     * @return string
     */
    public function getNameParam(): string;

    /**
     * @return string
     */
    public function getTokenParam(): string;

    /**
     * @param array $params
     * @param bool $external
     *
     * @return string
     */
    public function buildRedirectUrl(array $params, bool $external): string;
}
