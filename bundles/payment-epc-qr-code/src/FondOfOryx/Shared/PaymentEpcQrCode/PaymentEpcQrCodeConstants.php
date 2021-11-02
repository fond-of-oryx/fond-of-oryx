<?php

declare(strict_types = 1);

namespace FondOfOryx\Shared\PaymentEpcQrCode;

interface PaymentEpcQrCodeConstants
{
    /**
     * @var string
     */
    public const EPC_QR_CODE_DATA_VERSION = 'EPC_QR_CODE_DATA_VERSION';

    /**
     * @var string
     */
    public const EPC_QR_CODE_DATA_VERSION_DEFAULT = '002';

    /**
     * @var string
     */
    public const EPC_QR_CODE_DATA_SERVICE_TAG = 'EPC_QR_CODE_DATA_SERVICE_TAG';

    /**
     * @var string
     */
    public const EPC_QR_CODE_DATA_SERVICE_TAG_DEFAULT = 'BCD';

    /**
     * @var string
     */
    public const EPC_QR_CODE_DATA_ENCODING = 'EPC_QR_CODE_DATA_ENCODING';

    /**
     * @var string
     */
    public const EPC_QR_CODE_DATA_ENCODING_DEFAULT = 'UTF-8';

    /**
     * @var string
     */
    public const EPC_QR_CODE_DATA_TYPE = 'EPC_QR_CODE_DATA_TYPE';

    /**
     * @var string
     */
    public const EPC_QR_CODE_DATA_TYPE_DEFAULT = 'SCT';

    /**
     * @var string
     */
    public const EPC_QR_CODE_DATA_PURPOSE = 'EPC_QR_CODE_DATA_PURPOSE';

    /**
     * @var string
     */
    public const EPC_QR_CODE_QR_CODE_FORMAT = 'EPC_QR_CODE_QR_CODE_FORMAT';

    /**
     * @var string
     */
    public const EPC_QR_CODE_QR_CODE_ENCODING_OVERRIDE = 'EPC_QR_CODE_QR_CODE_ENCODING_OVERRIDE';

    /**
     * @var string
     */
    public const EPC_QR_CODE_QR_CODE_ERROR_CORRECTION_LEVEL_OVERRIDE = 'EPC_QR_CODE_QR_CODE_ERROR_CORRECTION_LEVEL_OVERRIDE';

    /**
     * @var string
     */
    public const EPC_QR_CODE_QR_CODE_SIZE_OVERRIDE = 'EPC_QR_CODE_QR_CODE_SIZE_OVERRIDE';

    /**
     * @var string
     */
    public const EPC_QR_CODE_QR_CODE_MARGIN_OVERRIDE = 'EPC_QR_CODE_QR_CODE_MARGIN_OVERRIDE';

    /**
     * @var string
     */
    public const EPC_QR_CODE_QR_CODE_FOREGROUND_COLOR_OVERRIDE = 'EPC_QR_CODE_QR_CODE_FOREGROUND_COLOR_OVERRIDE';

    /**
     * @var string
     */
    public const EPC_QR_CODE_QR_CODE_ROUNDED_BLOCK_SIZE_MODE_OVERRIDE = 'EPC_QR_CODE_QR_CODE_ROUNDED_BLOCK_SIZE_MODE_OVERRIDE';

    /**
     * @var string
     */
    public const EPC_QR_CODE_QR_CODE_BACKGROUND_COLOR_OVERRIDE = 'EPC_QR_CODE_QR_CODE_BACKGROUND_COLOR_OVERRIDE';
}
