<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use FondOfOryx\Shared\JellyfishGiftCard\JellyfishGiftCardConstants;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\RendererInterface;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Generated\Shared\Transfer\JellyfishGiftCardTransfer;

class JellyfishGiftCardMapper implements JellyfishGiftCardMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailMapperInterface
     */
    protected $jellyfishMailMapper;

    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\RendererInterface
     */
    protected $renderer;

    /**
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailMapperInterface $jellyfishMailMapper
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\RendererInterface $renderer
     */
    public function __construct(
        JellyfishMailMapperInterface $jellyfishMailMapper,
        RendererInterface $renderer
    ) {
        $this->jellyfishMailMapper = $jellyfishMailMapper;
        $this->renderer = $renderer;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishGiftCardTransfer|null
     */
    public function fromJellyfishGiftCardRequest(
        JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
    ): ?JellyfishGiftCardTransfer {
        $giftCardTransfer = $jellyfishGiftCardRequestTransfer->getGiftCard();

        if ($giftCardTransfer === null) {
            return null;
        }

        $jellyfishMailTransfer = $this->jellyfishMailMapper->fromJellyfishGiftCardRequest(
            $jellyfishGiftCardRequestTransfer
        );

        if ($jellyfishMailTransfer === null) {
            return null;
        }

        return (new JellyfishGiftCardTransfer())->setCode($giftCardTransfer->getCode())
            ->setAmount($giftCardTransfer->getActualValue() / 100)
            ->setTemplate($this->getTemplateByJellyfishGiftCardRequest($jellyfishGiftCardRequestTransfer))
            ->setMail($jellyfishMailTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
     *
     * @return string|null
     */
    protected function getTemplateByJellyfishGiftCardRequest(
        JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
    ): ?string {
        $localeTransfer = $jellyfishGiftCardRequestTransfer->getLocale();

        if ($localeTransfer === null) {
            return null;
        }

        return $this->renderer->render(
            JellyfishGiftCardConstants::LAYOUT_TEMPLATE_GIFT_CARD_HTML,
            $localeTransfer,
            $jellyfishGiftCardRequestTransfer->toArray(true, false)
        );
    }
}
