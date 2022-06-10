<?php

namespace FondOfOryx\Service\Trbo\Mapper;

use Generated\Shared\Transfer\TrboTransfer;

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
     * @return \Generated\Shared\Transfer\TrboTransfer
     */
    public function mapApiResponseToTransfer(array $data): TrboTransfer
    {
        $trboTransfer = new TrboTransfer();

        if (!isset($data[static::DATA])) {
            return $trboTransfer;
        }

        return $this->mergeDataAndTracking($trboTransfer, $data);
    }

    /**
     * @param \Generated\Shared\Transfer\TrboTransfer $trboTransfer
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\TrboTransfer
     */
    protected function mergeDataAndTracking(TrboTransfer $trboTransfer, array $data): TrboTransfer
    {
        $trboData = [];

        foreach ($data[static::DATA] as $index => $item) {
            if (isset($data[static::TRACKING][$index])) {
                $trboData[] = (array_merge($item, $data[static::TRACKING][$index]));

                continue;
            }

            $trboData[] = $item;
        }

        return $trboTransfer->setData($trboData);
    }
}
