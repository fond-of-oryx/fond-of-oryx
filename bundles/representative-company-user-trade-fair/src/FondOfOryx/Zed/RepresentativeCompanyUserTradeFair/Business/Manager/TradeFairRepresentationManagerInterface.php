<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Business\Manager;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer;
use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;

interface TradeFairRepresentationManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function create(RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function update(RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function findByUuid(string $uuid): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param string $uuid
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function delete(string $uuid): RepresentativeCompanyUserTradeFairTransfer;

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairCollectionTransfer
     */
    public function get(RepresentativeCompanyUserTradeFairFilterTransfer $filterTransfer): RepresentativeCompanyUserTradeFairCollectionTransfer;

    /**
     * @return void
     */
    public function checkForExpiration(): void;
}
