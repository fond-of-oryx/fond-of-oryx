<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepositoryInterface;
use Generated\Shared\Transfer\CompanyUnitAddressTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class CompanyUnitAddressResourceReader implements CompanyUnitAddressResourceReaderInterface
{
    /**
     * @var \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepositoryInterface
     */
    protected $repository;

    /**
     * @param \FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepositoryInterface $repository
     */
    public function __construct(ReturnLabelRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param \Generated\Shared\Transfer\ReturnLabelRequestTransfer $returnLabelRequestTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUnitAddressTransfer|null
     */
    public function getByReturnLabelRequest(ReturnLabelRequestTransfer $returnLabelRequestTransfer): ?CompanyUnitAddressTransfer
    {
        return $this->repository->getCompanyUnitAddressByReturnLabelRequest($returnLabelRequestTransfer);
    }
}
