<?php

declare(strict_types = 1);

namespace FondOfOryx\Shared\PaymentEpcQrCode;

interface PaymentEpcQrCodeConstants
{
    public const QR_CODE_ENCODING = 'QR_CODE_ENCODING';
    public const QR_CODE_SIZE = 'QR_CODE_SIZE';
    public const QR_CODE_MARGIN = 'QR_CODE_MARGIN';
    public const QR_CODE_ERROR_CORRECTION_LEVEL = 'QR_CODE_ERROR_CORRECTION_LEVEL';
    public const QR_CODE_ROUNDED_BLOCK_SIZE_MODE = 'QR_CODE_ROUNDED_BLOCK_SIZE_MODE';
    public const QR_CODE_FOREGROUND_COLOR = 'QR_CODE_FOREGROUND_COLOR';
    public const QR_CODE_BACKGROUND_COLOR = 'QR_CODE_BACKGROUND_COLOR';
    public const EPC_QR_CODE_VERSION = 'EPC_QR_CODE_VERSION';
    public const EPC_QR_CODE_SERVICE_TAG = 'EPC_QR_CODE_SERVICE_TAG';
    public const EPC_QR_CODE_ENCODING = 'EPC_QR_CODE_ENCODING';
    public const EPC_QR_CODE_TYPE = 'EPC_QR_CODE_TYPE';
    public const EPC_QR_CODE_PURPOSE = 'EPC_QR_CODE_PURPOSE';
}
