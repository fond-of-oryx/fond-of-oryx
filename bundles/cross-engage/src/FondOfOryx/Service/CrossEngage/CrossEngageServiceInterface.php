<?php

namespace FondOfOryx\Service\CrossEngage;

use Symfony\Component\Form\FormInterface;

interface CrossEngageServiceInterface
{
    /**
     * @param array $params
     *
     * @return string
     */
    public function getOptInUrl(array $params): string;

    /**
     * @param array $params
     *
     * @return string
     */
    public function getOptOutUrl(array $params): string;

    /**
     * @param array $params
     * @param bool $isExternal
     *
     * @return string
     */
    public function getRedirectUrl(array $params, bool $isExternal = false): string;

    /**
     * @throws \Spryker\Shared\Kernel\Locale\LocaleNotFoundException
     *
     * @return string
     */
    public function getLanguagePrefix(): string;

    /**
     * @param string $string
     *
     * @return string
     */
    public function getHash(string $string): string;

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return bool
     */
    public function validateForm(FormInterface $form): bool;

    /**
     * @return string
     */
    public function getCrossEngageParamName(): string;

    /**
     * @return string
     */
    public function getCrossEngageTokenParamName(): string;
}
