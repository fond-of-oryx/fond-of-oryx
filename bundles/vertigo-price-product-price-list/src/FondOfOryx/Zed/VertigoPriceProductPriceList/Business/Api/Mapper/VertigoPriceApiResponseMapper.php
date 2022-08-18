<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Mapper;

use Generated\Shared\Transfer\VertigoPriceApiResponseTransfer;
use Psr\Http\Message\ResponseInterface;

class VertigoPriceApiResponseMapper implements VertigoPriceApiResponseMapperInterface
{
    /**
     * @var array
     */
    public const SUCCESSFULLY_STATUS_CODES = [202];

     /**
      * @param \Psr\Http\Message\ResponseInterface $response
      *
      * @return \Generated\Shared\Transfer\VertigoPriceApiResponseTransfer
      */
    public function fromResponse(ResponseInterface $response): VertigoPriceApiResponseTransfer
    {
        $statusCode = $response->getStatusCode();

        return (new VertigoPriceApiResponseTransfer())
            ->setStatus($statusCode)
            ->setIsSuccessful(in_array($statusCode, static::SUCCESSFULLY_STATUS_CODES, true));
    }
}
