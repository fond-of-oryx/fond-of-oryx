<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Expander;

use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelRequestExpander implements ReturnLabelRequestExpanderInterface
{
    /**
     * @var array
     */
    protected $returnLabelRequestExpanderPlugins;

    /**
     * @param array<\FondOfOryx\Zed\ReturnLabelsRestApiExtension\Dependency\Plugin\ReturnLabelRequestExpanderPluginInterface> $returnLabelRequestExpanderPlugins
     */
    public function __construct(array $returnLabelRequestExpanderPlugins)
    {
        $this->returnLabelRequestExpanderPlugins = $returnLabelRequestExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\ReturnLabelRequestTransfer
     */
    public function expand(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer,
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelRequestTransfer {
        foreach ($this->returnLabelRequestExpanderPlugins as $returnLabelRequestExpanderPlugin) {
            $returnLabelRequestTransfer = $returnLabelRequestExpanderPlugin->expand(
                $restReturnLabelRequestTransfer,
                $returnLabelRequestTransfer,
            );
        }

        return $returnLabelRequestTransfer;
    }
}
