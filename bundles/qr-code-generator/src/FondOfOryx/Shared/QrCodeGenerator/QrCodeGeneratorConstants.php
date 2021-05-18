<?php

declare(strict_types = 1);

namespace FondOfOryx\Shared\QrCodeGenerator;

interface QrCodeGeneratorConstants
{
    public const QR_CODE_FORMAT = 'QR_CODE_FORMAT';
    public const QR_CODE_ENCODING = 'QR_CODE_ENCODING';
    public const QR_CODE_SIZE = 'QR_CODE_SIZE';
    public const QR_CODE_MARGIN = 'QR_CODE_MARGIN';
    public const QR_CODE_ERROR_CORRECTION_LEVEL = 'QR_CODE_ERROR_CORRECTION_LEVEL';
    public const QR_CODE_ROUNDED_BLOCK_SIZE_MODE = 'QR_CODE_ROUNDED_BLOCK_SIZE_MODE';
    public const QR_CODE_FOREGROUND_COLOR = 'QR_CODE_FOREGROUND_COLOR';
    public const QR_CODE_BACKGROUND_COLOR = 'QR_CODE_BACKGROUND_COLOR';
}
