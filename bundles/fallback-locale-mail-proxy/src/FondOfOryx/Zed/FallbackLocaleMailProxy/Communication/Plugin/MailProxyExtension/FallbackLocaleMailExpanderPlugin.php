<?php

namespace FondOfOryx\Zed\FallbackLocaleMailProxy\Communication\Plugin\MailProxyExtension;

use FondOfOryx\Zed\MailProxyExtension\Dependency\Plugin\MailExpanderPluginInterface;
use Generated\Shared\Transfer\MailTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfOryx\Zed\FallbackLocaleMailProxy\Business\FallbackLocaleMailProxyFacadeInterface getFacade()
 */
class FallbackLocaleMailExpanderPlugin extends AbstractPlugin implements MailExpanderPluginInterface
{
 /**
  * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
  *
  * @return \Generated\Shared\Transfer\MailTransfer
  */
    public function expand(MailTransfer $mailTransfer): MailTransfer
    {
        return $this->getFacade()
            ->expandMail($mailTransfer);
    }
}
