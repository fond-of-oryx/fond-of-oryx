<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use Exception;
use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface;
use FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelTransfer;

class ReturnLabelGenerator implements ReturnLabelGeneratorInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface
     */
    protected $returnLabelAdapter;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig
     */
    protected $config;

    /**
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface $returnLabelAdapter
     * @param \FondOfOryx\Zed\ReturnLabel\ReturnLabelConfig $config
     */
    public function __construct(
        ReturnLabelAdapterInterface $returnLabelAdapter,
        ReturnLabelConfig $config
    ) {
        $this->returnLabelAdapter = $returnLabelAdapter;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelResponseTransfer
     */
    public function generate(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelResponseTransfer {
        $returnLabelResponseTransfer = (new ReturnLabelResponseTransfer())
            ->setIsSuccessful(false);

        $returnLabelRequestTransfer
            ->setReceiverId($this->config->getReceiverId())
            ->setQrCode($this->config->printQrCodeOnReturnForm())
            ->setReturnForm($this->config->appendReturnForm());

        try {
            $body = $this->returnLabelAdapter->sendRequest($returnLabelRequestTransfer);

            if ($body === null) {
                return $returnLabelResponseTransfer;
            }

            $returnLabelTransfer = (new ReturnLabelTransfer())
                ->setData($body->getContents());

            return $returnLabelResponseTransfer->setIsSuccessful(true)
                ->setReturnLabel($returnLabelTransfer);
        } catch (Exception $exception) {
            return $returnLabelResponseTransfer;
        }
    }
}
