<?php

declare(strict_types = 1);

namespace FondOfOryx\Zed\MailBcc\Business\Model\Expander;

use FondOfOryx\Zed\MailBcc\MailBccConfig;
use Generated\Shared\Transfer\MailRecipientTransfer;
use Generated\Shared\Transfer\MailTransfer;
use Generated\Shared\Transfer\OrderTransfer;

class MailBccExpander implements ExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\MailBcc\MailBccConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\MailBcc\MailBccConfig $config
     */
    public function __construct(MailBccConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\MailTransfer $mailTransfer
     * @param \Generated\Shared\Transfer\OrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\MailTransfer
     */
    public function expand(MailTransfer $mailTransfer, OrderTransfer $orderTransfer): MailTransfer
    {
        foreach ($this->config->getBccEmailAddress() as $mail => $name) {
            $mailTransfer->addRecipientBcc(
                $this->createMailRecipient($mail, $name),
            );
        }

        return $mailTransfer;
    }

    /**
     * @param string $eMail
     * @param string|null $name
     *
     * @return \Generated\Shared\Transfer\MailRecipientTransfer
     */
    protected function createMailRecipient(string $eMail, ?string $name = null): MailRecipientTransfer
    {
        return (new MailRecipientTransfer())
            ->setName($name)
            ->setEmail($eMail);
    }
}
