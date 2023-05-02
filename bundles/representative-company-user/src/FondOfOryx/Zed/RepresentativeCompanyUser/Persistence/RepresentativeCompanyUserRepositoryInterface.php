<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Persistence;

use Generated\Shared\Transfer\CompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

interface RepresentativeCompanyUserRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function findRepresentativeCompanyUserByUuid(string $uuid): RepresentativeCompanyUserTransfer;

    /**
     * @param string|null $state
     * @param array|null $ids
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function findRepresentativeCompanyUserByState(?string $state, ?array $ids = null): RepresentativeCompanyUserCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @throws \Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer|null
     */
    public function findRepresentativeCompanyUserByCase(
        RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
    ): ?RepresentativeCompanyUserTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer|null $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function findExpiredRepresentativeCompanyUser(
        ?RepresentativeCompanyUserFilterTransfer $filterTransfer = null
    ): RepresentativeCompanyUserCollectionTransfer;

    /**
     * @param int $fkDistributor
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer|null
     */
    public function findRepresentativeCompanyUserByFkDistributor(int $fkDistributor): ?RepresentativeCompanyUserCollectionTransfer;

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
    public function findCompanyUserByIdRepresentativeCompanyUser(int $idRepresentativeCompanyUser): CompanyUserCollectionTransfer;
}
