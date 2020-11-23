<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\MailBcc\Business;

use FondOfOryx\Zed\MailBcc\Business\Model\Expander\ExpanderInterface;
use FondOfOryx\Zed\MailBcc\Business\Model\Expander\MailBccExpander;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * Class MailBccBusinessFactory
 *
 * @package FondOfOryx\Zed\MailBcc\Business
 *
 * @method \FondOfOryx\Zed\MailBcc\MailBccConfig getConfig()
 */
class MailBccBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfOryx\Zed\MailBcc\Business\Model\Expander\ExpanderInterface
     */
    public function createMailBccExpander(): ExpanderInterface
    {
        return new MailBccExpander($this->getConfig());
    }
}
