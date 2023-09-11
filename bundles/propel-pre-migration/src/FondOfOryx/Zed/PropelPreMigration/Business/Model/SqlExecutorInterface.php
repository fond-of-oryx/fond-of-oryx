<?php

namespace FondOfOryx\Zed\PropelPreMigration\Business\Model;

interface SqlExecutorInterface
{
    /**
     * @param array $sqlFiles
     *
     * @return array
     */
    public function execute(array $sqlFiles): array;
}
