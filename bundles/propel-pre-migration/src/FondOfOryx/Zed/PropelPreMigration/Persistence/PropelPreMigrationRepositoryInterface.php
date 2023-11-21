<?php

namespace FondOfOryx\Zed\PropelPreMigration\Persistence;

interface PropelPreMigrationRepositoryInterface
{
    /**
     * @param array<string> $sqlFileNames
     *
     * @return array<\Generated\Shared\Transfer\PropelPreMigrationTransfer>
     */
    public function findPreMigrationsByFileNames(array $sqlFileNames): array;

    /**
     * @param array<string> $sqlFileNames
     *
     * @return array<string>
     */
    public function getNotMigratedFileNamesByFileNames(array $sqlFileNames): array;
}
