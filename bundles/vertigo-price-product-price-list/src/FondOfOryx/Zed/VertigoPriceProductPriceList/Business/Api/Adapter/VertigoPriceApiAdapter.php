<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Adapter;

use FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Mapper\VertigoPriceApiResponseMapperInterface;
use Generated\Shared\Transfer\VertigoPriceApiRequestTransfer;
use Generated\Shared\Transfer\VertigoPriceApiResponseTransfer;
use GuzzleHttp\ClientInterface;
use Psr\Log\LoggerInterface;
use Throwable;

class VertigoPriceApiAdapter implements VertigoPriceApiAdapterInterface
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * @var \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Mapper\VertigoPriceApiResponseMapperInterface
     */
    protected $vertigoPriceApiResponseMapper;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \GuzzleHttp\ClientInterface $client
     * @param \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\Api\Mapper\VertigoPriceApiResponseMapperInterface $vertigoPriceApiResponseMapper
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        ClientInterface $client,
        VertigoPriceApiResponseMapperInterface $vertigoPriceApiResponseMapper,
        LoggerInterface $logger
    ) {
        $this->client = $client;
        $this->vertigoPriceApiResponseMapper = $vertigoPriceApiResponseMapper;
        $this->logger = $logger;
    }

    /**
     * @param \Generated\Shared\Transfer\VertigoPriceApiRequestTransfer $vertigoPriceApiRequestTransfer
     *
     * @return \Generated\Shared\Transfer\VertigoPriceApiResponseTransfer
     */
    public function sendRequest(
        VertigoPriceApiRequestTransfer $vertigoPriceApiRequestTransfer
    ): VertigoPriceApiResponseTransfer {
        try {
            $response = $this->client->request(
                'POST',
                '/prices-to-shop/cache/prices',
                [
                    'headers' => [
                        'Content-Type' => 'application/json',
                    ], 'body' => $vertigoPriceApiRequestTransfer->getBody(),
                ],
            );

            return $this->vertigoPriceApiResponseMapper->fromResponse($response);
        } catch (Throwable $exception) {
            $this->logger->error($exception->getMessage(), ['trace' => $exception->getTraceAsString()]);
        }

        return (new VertigoPriceApiResponseTransfer())->setIsSuccessful(false);
    }
}
