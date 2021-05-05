<?php

namespace FondOfOryx\Zed\ReturnLabel\Business\Model;

use FondOfOryx\Zed\ReturnLabel\Persistence\ReturnLabelRepositoryInterface;
use Generated\Shared\Transfer\CompanyBusinessUnitTransfer;
use Generated\Shared\Transfer\ReturnLabelRequestTransfer;

class CompanyBusinessUnitResourceResourceReader implements CompanyBusinessUnitResourceReaderInterface
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
     * @return \Generated\Shared\Transfer\CompanyBusinessUnitTransfer
     */
    public function getByReturnLabelRequest(
        ReturnLabelRequestTransfer $returnLabelRequestTransfer
    ): CompanyBusinessUnitTransfer {
        return $this->repository->getCompanyBusinessUnitByReturnLabelRequest(
            $returnLabelRequestTransfer
        );
    }
}
