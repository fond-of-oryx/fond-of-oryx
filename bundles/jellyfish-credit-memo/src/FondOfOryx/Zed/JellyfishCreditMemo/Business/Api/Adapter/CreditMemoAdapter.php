<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Business\Api\Adapter;

use FondOfOryx\Zed\Jellyfish\Business\Api\Adapter\AbstractAdapter;
use FondOfOryx\Zed\JellyfishCreditMemo\Exception\ResponseErrorException;
use Psr\Http\Message\ResponseInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class CreditMemoAdapter extends AbstractAdapter
{
    protected const SUCCESS_CODE = 200;

    protected const CREDIT_MEMOS_URI = 'standard/credit-memos';

    /**
     * @return string
     */
    protected function getUri(): string
    {
        return static::CREDIT_MEMOS_URI;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @throws \FondOfOryx\Zed\JellyfishCreditMemo\Exception\ResponseErrorException
     *
     * @return void
     */
    protected function handleResponse(ResponseInterface $response, AbstractTransfer $transfer): void
    {
        if ($response->getStatusCode() !== static::SUCCESS_CODE) {
            throw new ResponseErrorException('Could not send refund response to jelly');
        }
    }
}
