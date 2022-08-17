<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Mapper;

use Generated\Shared\Transfer\VertigoPriceApiResponseTransfer;
use Psr\Http\Message\ResponseInterface;

interface VertigoPriceApiResponseMapperInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     *
     * @return \Generated\Shared\Transfer\VertigoPriceApiResponseTransfer
     */
    public function fromResponse(ResponseInterface $response): VertigoPriceApiResponseTransfer;
}
