<?php

namespace FondOfOryx\Service\CrossEngage;

use Spryker\Service\Kernel\AbstractService;
use Symfony\Component\Form\FormInterface;

/**
 * @method \FondOfOryx\Service\CrossEngage\CrossEngageServiceFactory getFactory()
 */
class CrossEngageService extends AbstractService implements CrossEngageServiceInterface
{
    /**
     * @param array $params
     *
     * @return string
     */
    public function getOptInUrl(array $params): string
    {
        return $this->getFactory()->createCrossEngageUrlBuilder()->buildOptInUrl($params);
    }

    /**
     * @param array $params
     *
     * @return string
     */
    public function getOptOutUrl(array $params): string
    {
        return $this->getFactory()->createCrossEngageUrlBuilder()->buildOptOutUrl($params);
    }

    /**
     * @param array $params
     * @param bool $isExternal
     *
     * @return string
     */
    public function getRedirectUrl(array $params, bool $isExternal = true): string
    {
        return $this->getFactory()->createCrossEngageUrlBuilder()->buildRedirectUrl($params, $isExternal);
    }

    /**
     * @return string
     */
    public function getLanguagePrefix(): string
    {
        return $this->getFactory()->createLanguagePrefixResolver()->resolve();
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function getHash(string $string): string
    {
        return $this->getFactory()->createHashGenerator()->generate($string);
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     *
     * @return bool
     */
    public function validateForm(FormInterface $form): bool
    {
        return $this->getFactory()->createFormValidatorCollection()->execValidation($form);
    }

    /**
     * @return string
     */
    public function getCrossEngageParamName(): string
    {
        return $this->getFactory()->createCrossEngageUrlBuilder()->getNameParam();
    }

    /**
     * @return string
     */
    public function getCrossEngageTokenParamName(): string
    {
        return $this->getFactory()->createCrossEngageUrlBuilder()->getTokenParam();
    }
}
