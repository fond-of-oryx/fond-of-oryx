<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\RestReturnLabelRequestTransfer;

class CompanyUnitAddressReader implements CompanyUnitAddressReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface $repository
     */
    public function __construct(ReturnLabelsRestApiRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getCompanyUnitAddressByRestReturnLabel(
        RestReturnLabelRequestTransfer $restReturnLabelRequestTransfer
    ): ?CompanyUnitAddressTransfer {
        $companyUnitAddressUuid = $restReturnLabelRequestTransfer->getCompanyUnitAddressUuid();

        if ($companyUnitAddressUuid === null) {
            return null;
        }

        return $this->repository->getCompanyUnitAddressByCompanyUnitAddressUuid(
            $companyUnitAddressUuid
        );
    }
}
