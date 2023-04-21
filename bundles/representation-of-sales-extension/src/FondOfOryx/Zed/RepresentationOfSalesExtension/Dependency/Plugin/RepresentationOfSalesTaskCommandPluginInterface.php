<?php

namespace FondOfOryx\Zed\RepresentationOfSalesExtension\Dependency\Plugin;

use Generated\Shared\Transfer\RepresentationOfSalesFilterTransfer;

interface RepresentationOfSalesTaskCommandPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\RepresentationOfSalesFilterTransfer $filter
     *
     * @return void
     */
    public function run(RepresentationOfSalesFilterTransfer $filter): void;

    /**
     * @return string
     */
    public function getName(): string;
}
