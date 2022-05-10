<?php

namespace FondOfOryx\Shared\LogLogIoConnector;

interface LogLogIoConnectorConstants
{
    /**
     * @var string
     */
    public const HOST = 'FOND_OF_ORYX:LOG_IO:HOST';

    /**
     * @var string
     */
    public const HOST_DEFAULT = '127.0.0.1';

    /**
     * @var string
     */
    public const PORT = 'FOND_OF_ORYX:LOG_IO:PORT';

    /**
     * @var int
     */
    public const PORT_DEFAULT = 6689;

    /**
     * @var string
     */
    public const LINE_FORMATTER_FORMAT = "+msg|php-fpm|%channel%|[%datetime%] [%level_name%] %message% %context% %extra%\0";
}
