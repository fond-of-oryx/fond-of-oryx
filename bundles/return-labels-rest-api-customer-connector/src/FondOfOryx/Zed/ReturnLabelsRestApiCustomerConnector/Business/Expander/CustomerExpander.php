<?php


namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander;

use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReaderInterface;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class CustomerExpander implements CustomerExpanderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReaderInterface
     */
    protected $customerReader;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReaderInterface $customerReader
     */
    public function __construct(CustomerReaderInterface $customerReader)
    {
        $this->customerReader = $customerReader;
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
        $customerTransfer = $this->customerReader
            ->getByRestReturnLabelRequest($restReturnLabelRequestTransfer);

        if ($customerTransfer === null) {
            return $returnLabelRequestTransfer;
        }

        $returnLabelRequestTransfer->getCustomer()
            ->setEmail($customerTransfer->getEmail())
            ->setReference($restReturnLabelRequestTransfer->getCustomer()->getReference());
    }
}
