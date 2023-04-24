<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUserExtension\Dependency\Plugin;

use Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer;

interface RepresentativeCompanyUserTaskCommandPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserFilterTransfer $filter
     *
     * @return void
     */
    public function run(RepresentativeCompanyUserFilterTransfer $filter): void;

    /**
     * @return string
     */
    public function getName(): string;
}
