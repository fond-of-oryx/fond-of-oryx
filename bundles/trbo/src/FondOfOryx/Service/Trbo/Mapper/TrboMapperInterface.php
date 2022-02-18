<?php

namespace FondOfOryx\Service\Trbo\Mapper;

use Generated\Shared\Transfer\TrboDataTransfer;

interface TrboMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\TrboDataTransfer
     */
    public function mapApiResponseToTransfer(array $data): TrboDataTransfer;
}
