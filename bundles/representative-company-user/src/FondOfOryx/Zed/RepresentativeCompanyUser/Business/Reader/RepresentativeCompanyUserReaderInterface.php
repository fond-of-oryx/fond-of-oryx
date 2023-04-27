<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader;

use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;

interface RepresentativeCompanyUserReaderInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function getAndFlagInProcessNewRepresentativeCompanyUser(RepresentativeCompanyUserFilterTransfer $filterTransfer): RepresentativeCompanyUserCollectionTransfer;

    /**
     * @param string|null $state
     * @param array|null $ids
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     */
    public function getRepresentativeCompanyUserByState(?string $state, ?array $ids = null): RepresentativeCompanyUserCollectionTransfer;

    /**
     * @param int $idCustomer
     *
     * @return \Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    public function getAllCompanyUserByCustomerId(int $idCustomer): CompanyUserCollectionTransfer;

    /**
     * @param int $idRepresentativeCompanyUser
     *
     * @return \Generated\Shared\Transfer\CompanyUserCollectionTransfer
     */
    public function getAllCompanyUserByFkRepresentativeCompanyUser(int $idRepresentativeCompanyUser): CompanyUserCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function getExpiredRepresentativeCompanyUser(RepresentativeCompanyUserFilterTransfer $filterTransfer): RepresentativeCompanyUserCollectionTransfer;
}