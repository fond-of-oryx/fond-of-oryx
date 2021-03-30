<?php

namespace FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Api\Adapter;

use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToLocaleFacadeInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Facade\JellyfishAvailabilityAlertToStoreFacadeInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\Business\Dependency\Service\JellyfishAvailabilityAlertToUtilEncodingServiceInterface;
use FondOfOryx\Zed\JellyfishAvailabilityAlert\JellyfishAvailabilityAlertConfig;
use FondOfSpryker\Zed\Jellyfish\Business\Api\Adapter\AbstractAdapter as FondOfSprykerJellyfishAbstractAdapter;
use Generated\Shared\Transfer\AvailabilityAlertConfigurationTransfer;
use Generated\Shared\Transfer\AvailabilityAlertDataWrapperTransfer;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class AvailabilityAlertAdapter extends FondOfSprykerJellyfishAbstractAdapter implements AvailabilityAlertAdapterInterface
{
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
        $this->username = $config->getUsername();
        $this->password = $config->getPassword();
        $this->dryRun = $config->dryRun();
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @return \Psr\Http\Message\StreamInterface|null
     */
    public function sendRequest(AbstractTransfer $transfer): ?StreamInterface
    {
        if ($transfer instanceof AvailabilityAlertDataWrapperTransfer) {
            //ToDo: Move this to a better place
            $configuration = (new AvailabilityAlertConfigurationTransfer())
                ->setStoreName($this->storeFacade->getCurrentStore()->getName())
                ->setPath('availability/notification/%s/%s')
                ->setLocaleName($this->localeFacade->getCurrentLocale()->getLocaleName());

            $transfer->setConfiguration($configuration);
        }

        return parent::sendRequest($transfer);
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
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     *
     * @return void
     */
    protected function handleResponse(ResponseInterface $response, AbstractTransfer $transfer): void
    {
    }
}
