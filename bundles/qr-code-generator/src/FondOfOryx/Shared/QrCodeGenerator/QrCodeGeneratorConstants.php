<?php

declare(strict_types = 1);

namespace FondOfOryx\Shared\QrCodeGenerator;

interface QrCodeGeneratorConstants
{
    /**
     * @var string
     */
    public const QR_CODE_FORMAT = 'QR_CODE_FORMAT';

    /**
     * @var string
     */
    public const QR_CODE_FORMAT_DEFAULT = 'png';

    /**
     * @var string
     */
    public const QR_CODE_ENCODING = 'QR_CODE_ENCODING';

    /**
     * @var string
     */
    public const QR_CODE_ENCODING_DEFAULT = 'UTF-8';

    /**
     * @var string
     */
    public const QR_CODE_SIZE = 'QR_CODE_SIZE';

    /**
     * @var int
     */
    public const QR_CODE_SIZE_DEFAULT = 250;

    /**
     * @var string
     */
    public const QR_CODE_MARGIN = 'QR_CODE_MARGIN';

    /**
     * @var int
     */
    public const QR_CODE_MARGIN_DEFAULT = 5;

    /**
     * @var string
     */
    public const QR_CODE_ERROR_CORRECTION_LEVEL = 'QR_CODE_ERROR_CORRECTION_LEVEL';

    /**
     * @var int
     */
    public const QR_CODE_ERROR_CORRECTION_LEVEL_DEFAULT = 1;

    /**
     * @var string
     */
    public const QR_CODE_ROUNDED_BLOCK_SIZE_MODE = 'QR_CODE_ROUNDED_BLOCK_SIZE_MODE';

    /**
     * @var int
     */
    public const QR_CODE_ROUNDED_BLOCK_SIZE_MODE_DEFAULT = 1;

    /**
     * @var string
     */
    public const QR_CODE_FOREGROUND_COLOR = 'QR_CODE_FOREGROUND_COLOR';

    /**
     * @var array
     */
    public const QR_CODE_FOREGROUND_COLOR_DEFAULT = [0, 0, 0];

    /**
     * @var string
     */
    public const QR_CODE_BACKGROUND_COLOR = 'QR_CODE_BACKGROUND_COLOR';

    /**
     * @var array
     */
    public const QR_CODE_BACKGROUND_COLOR_DEFAULT = [255, 255, 255];
}
