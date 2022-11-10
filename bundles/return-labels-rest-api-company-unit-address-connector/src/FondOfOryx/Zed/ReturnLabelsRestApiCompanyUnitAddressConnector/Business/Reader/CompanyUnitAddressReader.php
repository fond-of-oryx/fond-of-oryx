<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Business\Reader;

use FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\ReturnLabelsRestApiCompanyUnitAddressConnectorRepositoryInterface;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

class CompanyUnitAddressReader implements CompanyUnitAddressReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\ReturnLabelsRestApiCompanyUnitAddressConnectorRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApiCompanyUnitAddressConnector\Persistence\ReturnLabelsRestApiCompanyUnitAddressConnectorRepositoryInterface $repository
     */
    public function __construct(ReturnLabelsRestApiCompanyUnitAddressConnectorRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getByRestReturnLabelRequest(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ?CompanyUnitAddressTransfer {
        if ($restReturnLabelRequestTransfer->getCustomer() === null) {
            return null;
        }

        $restAddressTransfer = $restReturnLabelRequestTransfer->getAddress();

        if ($restAddressTransfer === null || $restAddressTransfer->getId() === null) {
            return null;
        }

        return $this->repository->getCompanyUnitAddressByUuid($restAddressTransfer->getId());
    }
}
