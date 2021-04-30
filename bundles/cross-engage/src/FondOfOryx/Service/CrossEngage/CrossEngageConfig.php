<?php

namespace FondOfOryx\Service\CrossEngage;

use FondOfOryx\Shared\CrossEngage\CrossEngageConstants;
use Spryker\Service\Kernel\AbstractBundleConfig;

/**
 * Class CrossEngageConfig
 *
 * @package FondOfOryx\Service\CrossEngage
 */
class CrossEngageConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getHostYves(): string
    {
        return $this->get(CrossEngageConstants::BASE_URL_YVES);
    }

    /**
     * @return string
     */
    public function getOptInPathPattern(): string
    {
        return $this->get(CrossEngageConstants::OPT_IN_PATH_PATTERN, '%s/%s/confirm-subscription/%s');
    }

    /**
     * @return string
     */
    public function getOptoutPathPattern(): string
    {
        return $this->get(CrossEngageConstants::OPT_OUT_PATH_PATTERN, '%s/%s/unsubscribe/%s');
    }

    /**
     * @return string
     */
    public function getCrossEngageRedirectPattern(): string
    {
        return $this->get(CrossEngageConstants::CROSSENGAGE_REDIRECT_PATTERN, '%s/%s/%s');
    }

    /**
     * @return string
     */
    public function getHashAlgo(): string
    {
        return $this->get(CrossEngageConstants::CROSSENGAGE_HASH_ALGO, 'sha1');
    }

    /**
     * @return bool
     */
    public function getModifyIn(): bool
    {
        return $this->get(CrossEngageConstants::CROSSENGAGE_MODIFY_IN, true);
    }

    /**
     * @return bool
     */
    public function getModifyOut(): bool
    {
        return $this->get(CrossEngageConstants::CROSSENGAGE_MODIFY_OUT, false);
    }

    /**
     * @return string
     */
    public function getModifierIn(): string
    {
        return $this->get(CrossEngageConstants::CROSSENGAGE_MODIFIER_IN, 'lower');
    }

    /**
     * @return string
     */
    public function getModifierOut(): string
    {
        return $this->get(CrossEngageConstants::CROSSENGAGE_MODIFIER_OUT, 'lower');
    }
}
