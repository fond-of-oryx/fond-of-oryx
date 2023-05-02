<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Task;

use Generated\Shared\Transfer\RepresentativeCompanyUserCommandTransfer;

interface TaskRunnerInterface
{
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
