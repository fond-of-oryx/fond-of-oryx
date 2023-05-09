<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Persistence;

use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

interface RepresentativeCompanyUserEntityManagerInterface
{
    /**
     * @return string
     */
    public function getInProcessState(): string;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function createRepresentativeCompanyUser(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function updateRepresentativeCompanyUser(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer;

    /**
     * @param string $uuid
     * @param string $state
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function flagState(string $uuid, string $state): RepresentativeCompanyUserTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function findAndFlagInProcessNewRepresentativeCompanyUser(
        RepresentativeCompanyUserFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserCollectionTransfer;

    /**
     * @param string $state
     * @param string $newState
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function findAndFlagRepresentativeCompanyUserByState(
        string $state,
        string $newState,
        RepresentativeCompanyUserFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserCollectionTransfer;
}
