<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade;

use FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelFacadeInterface;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelsRestApiToReturnLabelFacadeBridge implements ReturnLabelsRestApiToReturnLabelFacadeInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelFacadeInterface
     */
    protected $returnLabelFacade;

    /**
     * @param \FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelFacadeInterface $returnLabelFacade
     */
    public function __construct(ReturnLabelFacadeInterface $returnLabelFacade)
    {
        $this->returnLabelFacade = $returnLabelFacade;
    }

    /**
     * @inheritDoc
     */
    public function generateReturnLabel(ReturnLabelRequestTransfer $returnLabelRequestTransfer): void
    {
        $this->returnLabelFacade->generateReturnLabel($returnLabelRequestTransfer);
    }
}
