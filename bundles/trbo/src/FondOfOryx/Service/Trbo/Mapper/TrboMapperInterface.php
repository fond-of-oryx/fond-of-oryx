<?php

namespace FondOfOryx\Service\Trbo\Mapper;

use Generated\Shared\Transfer\TrboTransfer;

interface TrboMapperInterface
{
    /**
     * @param array $data
     *
     * @return \Generated\Shared\Transfer\TrboTransfer
     */
    public function mapApiResponseToTransfer(array $data): TrboTransfer;
}
