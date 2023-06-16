<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFairRestApi\Dependency\Facade;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;

interface RepresentativeCompanyUserTradeFairRestApiToRepresentativeCompanyUserTradeFairFacadeInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function addRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
    ): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function updateRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
    ): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function findTradeFairRepresentationByUuid(string $uuid): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function deleteRepresentativeCompanyUserTradeFair(string $uuid): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
     */
    public function getRepresentativeCompanyUserTradeFair(
        RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
    ): RepresentativeCompanyUserTradeFairCollectionTransfer;
}
