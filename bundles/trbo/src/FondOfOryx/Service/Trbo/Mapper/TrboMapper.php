<?php

namespace FondOfOryx\Service\Trbo\Mapper;

use Generated\Shared\Transfer\TrboDataTransfer;

class TrboMapper implements TrboMapperInterface
{
    /**
     * @var string
     */
    public const DATA = 'data';

    /**
     * @var string
     */
    public const TRACKING = 'tracking';

    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\TrboDataTransfer
     */
    public function mapApiResponseToTransfer(array $data): TrboDataTransfer
    {
        $trboDataTransfer = new TrboDataTransfer();

        if (!isset($data[static::DATA])) {
            return $trboDataTransfer;
        }

        return $this->mergeDataAndTracking($trboDataTransfer, $data);
    }

    /**
     * @param \Generated\Shared\Transfer\TrboDataTransfer $trboDataTransfer
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\TrboDataTransfer
     */
    protected function mergeDataAndTracking(TrboDataTransfer $trboDataTransfer, array $data): TrboDataTransfer
    {
        $trboData = [];

        foreach ($data[static::DATA] as $index => $item) {
            if (isset($data[static::TRACKING][$index])) {
                $trboData[] = (array_merge($item, $data[static::TRACKING][$index]));

                continue;
            }

            $trboData[] = $item;
        }

        return $trboDataTransfer->setData($trboData);
    }
}
