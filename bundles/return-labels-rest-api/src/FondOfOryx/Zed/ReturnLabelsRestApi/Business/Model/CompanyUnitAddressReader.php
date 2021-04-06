<?php

namespace FondOfOryx\Zed\ReturnLabelsRestApi\Business\Model;

use FondOfOryx\Zed\ReturnLabelsRestApi\Persistence\ReturnLabelsRestApiRepositoryInterface;
use Generated\Shared\Transfer\RestReturnLabelTransfer;

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
     * @param \Generated\Shared\Transfer\RestReturnLabelTransfer $restReturnLabelTransfer
     *
     * @return int|null
     */
    public function getIdCompanyUnitAddressByRestReturnLabel(RestReturnLabelTransfer $restReturnLabelTransfer): ?int
    {
        $companyUnitAddressUuid = $restReturnLabelTransfer->getCompanyUnitAddressUuid();

        if ($companyUnitAddressUuid === null) {
            return null;
        }

        return $this->repository->getIdCompanyUnitAddressByCompanyUnitAddressUuid(
            $companyUnitAddressUuid
        );
    }
}
