<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use FondOfOryx\Zed\ReturnLabelsRestApi\Business\Expander\ReturnLabelRequestExpanderInterface;
use FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\RestReturnLabelResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelGenerator implements ReturnLabelGeneratorInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface
     */
    protected $returnLabelFacade;

    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Expander\ReturnLabelRequestExpanderInterface
     */
    protected $returnLabelRequestExpander;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade\ReturnLabelsRestApiToReturnLabelFacadeInterface $returnLabelFacade
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Business\Expander\ReturnLabelRequestExpanderInterface $returnLabelRequestExpander
     */
    public function __construct(
        ReturnLabelsRestApiToReturnLabelFacadeInterface $returnLabelFacade,
        ReturnLabelRequestExpanderInterface $returnLabelRequestExpander
    ) {
        $this->returnLabelFacade = $returnLabelFacade;
        $this->returnLabelRequestExpander = $returnLabelRequestExpander;
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\RestReturnLabelResponseTransfer
     */
    public function generate(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): RestReturnLabelResponseTransfer {
        $returnLabelRequestTransfer = $this->returnLabelRequestExpander
            ->expand($restReturnLabelRequestTransfer, new ReturnLabelRequestTransfer());

        $returnLabelResponseTransfer = $this->returnLabelFacade
            ->generateReturnLabel($returnLabelRequestTransfer);

        return (new RestReturnLabelResponseTransfer())
            ->setIsSuccessful($returnLabelResponseTransfer->getIsSuccessful())
            ->setReturnLabel($returnLabelResponseTransfer->getReturnLabel());
    }
}
