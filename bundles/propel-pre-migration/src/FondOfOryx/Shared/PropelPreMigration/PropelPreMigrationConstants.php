<?php

namespace FondOfOryx\Shared\PropelPreMigration;

interface PropelPreMigrationConstants
{
    /**
     * @var string
     */
    public const CUSTOM_SQL_DIRECTORY = 'FOO:PROPEL_PRE_MIGRATION:CUSTOM_SQL_DIRECTORY';

    /**
     * @var string
     */
    public const GLOB_SQL_FILE_PATTERN = 'FOO:PROPEL_PRE_MIGRATION:GLOB_SQL_FILE_PATTERN';

    /**
     * @var string
     */
    public const GLOB_SQL_FILE_PATTERN_DEFAULT = '#\d{4}\d{1,2}\d{1,2}_\d{1,3}.sql$#';

    /**
     * @var string
     */
    public const KEY_SUCCESS = 'success';

    /**
     * @var string
     */
    public const KEY_FILE = 'file';

    /**
     * @var string
     */
    public const KEY_MESSAGE = 'message';
}
