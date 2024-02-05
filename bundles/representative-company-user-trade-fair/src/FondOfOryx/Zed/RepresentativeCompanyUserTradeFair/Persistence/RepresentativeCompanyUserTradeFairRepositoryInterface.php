<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;

interface RepresentativeCompanyUserTradeFairRepositoryInterface
{
    /**
     * @param string $uuid
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function findRepresentativeCompanyUserTradeFairByUuid(string $uuid): RepresentativeCompanyUserTradeFairTransfer;

   /**
    * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
    */
    public function findExpiredRepresentativeCompanyUserTradeFair(): RepresentativeCompanyUserTradeFairCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
     */
    public function getRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserTradeFairCollectionTransfer;

    /**
     * @param int $fkDistributor
     *
     * @throws \Spryker\Zed\Propel\Business\Exception\AmbiguousComparisonException
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer|null
     */
    public function findRepresentativeCompanyUserTradeFairByFkDistributor(int $fkDistributor): ?RepresentativeCompanyUserTradeFairCollectionTransfer;

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function findTradeFairByUuid(string $uuid): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param int $fkRepresentative
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return array
     */
    public function resolveDistributorFksToRepresent(int $fkRepresentative): array;

    /**
     * @return array
     */
    public function getUuidsOfExpiredTradeFairs(): array;
}
