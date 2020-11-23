<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\MailBcc;

use FondOfOryx\Shared\MailBcc\MailBccConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class MailBccConfig extends AbstractBundleConfig
{
    /**
     * @return string[]
     */
    public function getBccEmailAddress(): array
    {
        return $this->get(MailBccConstants::MAIL_BCC_ORDER, []);
    }
}
