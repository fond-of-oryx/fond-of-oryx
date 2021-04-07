<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Dependency\Facade;

use FondOfOryx\Zed\ReturnLabel\Business\ReturnLabelFacadeInterface;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelResponseTransfer;
use Generated\Shared\Transfer\ReturnLabelRestApiResponseTransfer;

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
     * @param ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return ReturnLabelResponseTransfer
     */
    public function generateReturnLabel(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): ReturnLabelResponseTransfer {
        return $this->returnLabelFacade
            ->generateReturnLabel($returnLabelRequestTransfer);
    }
}
