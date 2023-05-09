<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business;

use Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserCommandTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

interface RepresentativeCompanyUserFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForExpiration(RepresentativeCompanyUserFilterTransfer $filterTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return void
     */
    public function checkForActivation(RepresentativeCompanyUserFilterTransfer $filterTransfer): void;

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
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function findRepresentationByUuid(string $uuid): RepresentativeCompanyUserTransfer;

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function deleteRepresentativeCompanyUser(string $uuid): RepresentativeCompanyUserTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function getRepresentativeCompanyUser(RepresentativeCompanyUserFilterTransfer $filterTransfer): RepresentativeCompanyUserCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return void
     */
    public function deleteCompanyUserForRepresentation(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): void;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return void
     */
    public function createCompanyUserForRepresentation(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): void;

    /**
     * @param string $uuid
     * @param string $state
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function setRepresentationState(string $uuid, string $state): RepresentativeCompanyUserTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function getAndFlagInProcessNewRepresentativeCompanyUser(
        RepresentativeCompanyUserFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer $representativeCompanyUserCollectionTransfer
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserCollectionTransfer
     */
    public function setInProcess(
        RepresentativeCompanyUserCollectionTransfer $representativeCompanyUserCollectionTransfer
    ): RepresentativeCompanyUserCollectionTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserCommandTransfer $commandTransfer
     *
     * @return void
     */
    public function runTask(RepresentativeCompanyUserCommandTransfer $commandTransfer): void;

    /**
     * @return array<string>
     */
    public function getRegisteredProcessorNames(): array;
}
