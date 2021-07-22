<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper;

use FondOfOryx\Shared\JellyfishGiftCard\JellyfishGiftCardConstants;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\RendererInterface;
use Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer;
use Generated\Shared\Transfer\JellyfishMailBodyTransfer;

class JellyfishMailBodyMapper implements JellyfishMailBodyMapperInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\RendererInterface
     */
    protected $renderer;

    /**
     * @param \FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\RendererInterface $renderer
     */
    public function __construct(RendererInterface $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param \Generated\Shared\Transfer\JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
     *
     * @return \Generated\Shared\Transfer\JellyfishMailBodyTransfer|null
     */
    public function fromJellyfishGiftCardRequest(
        JellyfishGiftCardRequestTransfer $jellyfishGiftCardRequestTransfer
    ): ?JellyfishMailBodyTransfer {
        $localeTransfer = $jellyfishGiftCardRequestTransfer->getLocale();

        if ($localeTransfer === null) {
            return null;
        }

        $plainText = $this->renderer->render(
            JellyfishGiftCardConstants::LAYOUT_TEMPLATE_MAIL_TEXT,
            $localeTransfer,
            $jellyfishGiftCardRequestTransfer->toArray()
        );

        $html = $this->renderer->render(
            JellyfishGiftCardConstants::LAYOUT_TEMPLATE_MAIL_HTML,
            $localeTransfer,
            $jellyfishGiftCardRequestTransfer->toArray()
        );

        return (new JellyfishMailBodyTransfer())->setPlainText($plainText)
            ->setHtml($html);
    }
}
