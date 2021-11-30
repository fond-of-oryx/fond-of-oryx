<?php

namespace FondOfOryx\Service\Trbo\Mapper;

use Generated\Shared\Transfer\TrboDataTransfer;
use Generated\Shared\Transfer\TrboTrackingTransfer;

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
    public function mapDataToTransfer(array $data): TrboDataTransfer
    {
        $trboDataTransfer = new TrboDataTransfer();
        $trboDataTransfer = $this->addContentfulEntries($trboDataTransfer, $data);
        $trboDataTransfer = $this->addTrboTracking($trboDataTransfer, $data);

        return $trboDataTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\TrboDataTransfer $trboDataTransfer
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\TrboDataTransfer
     */
    protected function addContentfulEntries(TrboDataTransfer $trboDataTransfer, array $data): TrboDataTransfer
    {
        if (isset($data[static::DATA])) {
            foreach ($data[static::DATA] as $contentfulEntry) {
                $trboDataTransfer->addContentfulEntry($contentfulEntry);
            }
        }

        return $trboDataTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\TrboDataTransfer $trboDataTransfer
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\TrboDataTransfer
     */
    protected function addTrboTracking(TrboDataTransfer $trboDataTransfer, array $data): TrboDataTransfer
    {
        if (isset($data[static::TRACKING])) {
            foreach ($data[static::TRACKING] as $tracking) {
                $trboDataTransfer->addTrboTracking((new TrboTrackingTransfer())->fromArray($tracking, true));
            }
        }

        return $trboDataTransfer;
    }
}
