<?php

namespace FondOfOryx\Zed\PropelPreMigration\Business;

interface PropelPreMigrationFacadeInterface
{
    /**
     * @param array $files
     *
     * @return array
     */
    public function execute(array $files): array;
}
