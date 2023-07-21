<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserTradeFair\Persistence;

use Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer;

interface RepresentativeCompanyUserTradeFairEntityManagerInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer $representativeCompanyUserTradeFairTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTradeFairTransfer
     */
    public function createRepresentativeCompanyUserTradeFair(
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
    public function deactivate(string $uuid): RepresentativeCompanyUserTradeFairTransfer;
}
