<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface;
use Generated\Shared\Transfer\AddressesTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class ReturnLabelGenerator implements ReturnLabelGeneratorInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface
     */
    protected $companyUnitAddressReader;

    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface
     */
    protected $returnLabelAdapter;

    /**
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Model\CompanyUnitAddressReaderInterface $companyUnitAddressReader
     * @param \FondOfOryx\Zed\ReturnLabel\Business\Api\Adapter\ReturnLabelAdapterInterface $returnLabelAdapter
     */
    public function __construct(
        CompanyUnitAddressReaderInterface $companyUnitAddressReader,
        ReturnLabelAdapterInterface $returnLabelAdapter
        // TODO: ReturnLabelMapperInterface
    ) {
        $this->companyUnitAddressReader = $companyUnitAddressReader;
        $this->returnLabelAdapter = $returnLabelAdapter;
    }

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return void
     */
    public function generate(ReturnLabelRequestTransfer $returnLabelRequestTransfer): void //TODO: ReturnLabelResponseTransfer
    {
        $companyUnitAddressTransfer = $this->companyUnitAddressReader->getByReturnLabelRequest(
            $returnLabelRequestTransfer
        );

        if ($companyUnitAddressTransfer === null) {
            return;
        }

        // TODO: Map stuff

        $this->returnLabelAdapter->sendRequest(new AddressesTransfer()); //TODO: Use api transfer model

        // TODO: Map to ReturnLabelResponseTransfer and return
    }
}
