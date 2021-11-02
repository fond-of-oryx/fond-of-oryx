<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Expander;

use FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapperInterface;
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
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapperInterface
     */
    protected $returnLabelRequestCustomerMapper;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Reader\CustomerReaderInterface $customerReader
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCustomerConnector\Business\Mapper\ReturnLabelRequestCustomerMapperInterface $returnLabelRequestCustomerMapper
     */
    public function __construct(
        CustomerReaderInterface $customerReader,
        ReturnLabelRequestCustomerMapperInterface $returnLabelRequestCustomerMapper
    ) {
        $this->customerReader = $customerReader;
        $this->returnLabelRequestCustomerMapper = $returnLabelRequestCustomerMapper;
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

        if ($customerTransfer === null || $restReturnLabelRequestTransfer->getCustomer() === null) {
            return $returnLabelRequestTransfer;
        }

        $returnLabelRequestCustomerTransfer = $this->returnLabelRequestCustomerMapper->fromCustomerTransfer(
            $customerTransfer,
        );

        $returnLabelRequestCustomerTransfer->setReference(
            $restReturnLabelRequestTransfer->getCustomer()->getReference(),
        );

        $returnLabelRequestTransfer->setCustomer($returnLabelRequestCustomerTransfer);

        return $returnLabelRequestTransfer;
    }
}
