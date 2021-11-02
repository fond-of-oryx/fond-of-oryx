<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter;

use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToLocaleFacadeInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToStoreFacadeInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service\JellyfishAvailabilityAlertToUtilEncodingServiceInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\JellyfishAvailabilityAlertConfig;
use Generated\Shared\Transfer\AvailabilityAlertConfigurationTransfer;
use Generated\Shared\Transfer\AvailabilityAlertDataWrapperTransfer;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;
use Spryker\Shared\Log\LoggerTrait;

class AvailabilityAlertAdapter implements AvailabilityAlertAdapterInterface
{
    use LoggerTrait;

    /**
     * @var array
     */
    protected const DEFAULT_HEADERS = [
        'Accept' => 'application/json',
        'Content-Type' => 'application/json',
    ];

    /**
     * @var string
     */
    protected const URI = 'standard/availability-alert';

    /**
     * @var \FondOfOryx\Zed\JellyfishAvailabilityAlert\JellyfishAvailabilityAlertConfig
     */
    protected $config;

    /**
     * @var \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToStoreFacadeInterface
     */
    protected $storeFacade;

    /**
     * @var \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToLocaleFacadeInterface
     */
    protected $localeFacade;

    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * @var \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service\JellyfishAvailabilityAlertToUtilEncodingServiceInterface
     */
    protected $utilEncodingService;

    /**
     * @param \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service\JellyfishAvailabilityAlertToUtilEncodingServiceInterface $utilEncodingService
     * @param \GuzzleHttp\ClientInterface $client
     * @param \FondOfOryx\Zed\JellyfishAvailabilityAlert\JellyfishAvailabilityAlertConfig $config
     * @param \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToStoreFacadeInterface $storeFacade
     * @param \FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToLocaleFacadeInterface $localeFacade
     */
    public function __construct(
        JellyfishAvailabilityAlertToUtilEncodingServiceInterface $utilEncodingService,
        ClientInterface $client,
        JellyfishAvailabilityAlertConfig $config,
        JellyfishAvailabilityAlertToStoreFacadeInterface $storeFacade,
        JellyfishAvailabilityAlertToLocaleFacadeInterface $localeFacade
    ) {
        $this->utilEncodingService = $utilEncodingService;
        $this->client = $client;
        $this->storeFacade = $storeFacade;
        $this->localeFacade = $localeFacade;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertDataWrapperTransfer $availabilityAlertDataWrapperTransfer
     *
     * @return \Psr\Http\Message\StreamInterface|null
     */
    public function sendRequest(AvailabilityAlertDataWrapperTransfer $availabilityAlertDataWrapperTransfer): ?StreamInterface
    {
        //ToDo: Move this to a better place
        $configuration = (new AvailabilityAlertConfigurationTransfer())
            ->setStoreName($this->storeFacade->getCurrentStore()->getName())
            ->setPath('availability/notification/%s/%s')
            ->setLocaleName($this->localeFacade->getCurrentLocale()->getLocaleName());

        $availabilityAlertDataWrapperTransfer->setConfiguration($configuration);

        if ($this->config->dryRun() === true) {
            $this->getLogger()->error($this->utilEncodingService->encodeJson($availabilityAlertDataWrapperTransfer->toArray(true, true)));

            return null;
        }

        $options = $this->createOptions($availabilityAlertDataWrapperTransfer);
        $response = $this->send($options);

        $this->handleResponse($response, $availabilityAlertDataWrapperTransfer);

        return $response->getBody();
    }

    /**
     * @param \Generated\Shared\Transfer\AvailabilityAlertDataWrapperTransfer $availabilityAlertDataWrapperTransfer
     *
     * @return array
     */
    protected function createOptions(AvailabilityAlertDataWrapperTransfer $availabilityAlertDataWrapperTransfer): array
    {
        $options = [];

        $options[RequestOptions::HEADERS] = static::DEFAULT_HEADERS;
        if (!empty($this->config->getUsername()) && !empty($this->config->getPassword())) {
            $options[RequestOptions::AUTH] = [
                $this->config->getUsername(),
                $this->config->getPassword(),
            ];
        }
        $options['timeout'] = $this->config->getTimeout();
        $options[RequestOptions::BODY] = $this->utilEncodingService->encodeJson($availabilityAlertDataWrapperTransfer->toArray(true, true));

        return $options;
    }

    /**
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function send(array $options = []): ResponseInterface
    {
        $uri = $this->getUri();
        $optionsAsJson = $this->utilEncodingService->encodeJson($options);
        $logMessage = sprintf('API request [%s]: %s', $uri, $optionsAsJson);

        $this->getLogger()->info($logMessage);

        return $this->client->request('POST', $uri, $options);
    }

    /**
     * @return string
     */
    protected function getUri(): string
    {
        return sprintf('%s/%s', rtrim($this->config->getBaseUri(), '/'), static::URI);
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $availabilityAlertDataWrapperTransfer
     *
     * @return void
     */
    protected function handleResponse(ResponseInterface $response, AbstractTransfer $availabilityAlertDataWrapperTransfer): void
    {
    }
}
