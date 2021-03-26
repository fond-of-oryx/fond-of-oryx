<?php

namespace FondOfOryx\Zed\OneTimePassword;

use FondOfOryx\Shared\OneTimePassword\OneTimePasswordConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class OneTimePasswordConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getGermanWordListPath(): string
    {
        return $this->get(
            OneTimePasswordConstants::ONE_TIME_PASSWORD_GERMAN_WORD_LIST_PATH,
            'vendor/fond-of-oryx/fond-of-oryx/bundles/one-time-password/src/FondOfOryx/Shared/OneTimePassword/data/german-wordlist.txt'
        );
    }
}
