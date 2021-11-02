<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use FondOfOryx\Shared\JellyfishGiftCard\JellyfishGiftCardConstants;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGlossaryFacadeInterface;
use FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Generated\Shared\Transfer\JellyfishMailSenderTransfer;
use Generated\Shared\Transfer\JellyfishMailTransfer;

class JellyfishMailMapper implements JellyfishMailMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailRecipientMapperInterface
     */
    protected $jellyfishMailRecipientMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailBodyMapperInterface
     */
    protected $jellyfishMailBodyMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig
     */
    protected $config;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGlossaryFacadeInterface
     */
    protected $glossaryFacade;

    /**
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailRecipientMapperInterface $jellyfishMailRecipientMapper
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailBodyMapperInterface $jellyfishMailBodyMapper
     * @param \FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig $config
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGlossaryFacadeInterface $glossaryFacade
     */
    public function __construct(
        JellyfishMailRecipientMapperInterface $jellyfishMailRecipientMapper,
        JellyfishMailBodyMapperInterface $jellyfishMailBodyMapper,
        JellyfishGiftCardConfig $config,
        JellyfishGiftCardToGlossaryFacadeInterface $glossaryFacade
    ) {
        $this->jellyfishMailRecipientMapper = $jellyfishMailRecipientMapper;
        $this->config = $config;
        $this->glossaryFacade = $glossaryFacade;
        $this->jellyfishMailBodyMapper = $jellyfishMailBodyMapper;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishMailTransfer|null
     */
    public function fromJellyfishGiftCardRequest(
        JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
    ): ?JellyfishMailTransfer {
        $localeTransfer = $jellyfishGiftCardRequestTransfer->getLocale();

        if ($localeTransfer === null) {
            return null;
        }

        $jellyfishMailRecipientTransfer = $this->jellyfishMailRecipientMapper->fromJellyfishGiftCardRequest(
            $jellyfishGiftCardRequestTransfer,
        );

        $jellyfishMailBodyTransfer = $this->jellyfishMailBodyMapper->fromJellyfishGiftCardRequest(
            $jellyfishGiftCardRequestTransfer,
        );

        return (new JellyfishMailTransfer())->setRecipient($jellyfishMailRecipientTransfer)
            ->setSender($this->createJellyfishMailSender())
            ->setSubject($this->glossaryFacade->translate(JellyfishGiftCardConstants::SUBJECT, [], $localeTransfer))
            ->setBody($jellyfishMailBodyTransfer);
    }

    /**
     * @return \Generated\Shared\Transfer\JellyfishMailSenderTransfer
     */
    protected function createJellyfishMailSender(): JellyfishMailSenderTransfer
    {
        return (new JellyfishMailSenderTransfer())->setName($this->config->getSenderName())
            ->setEmail($this->config->getSenderEmail());
    }
}
