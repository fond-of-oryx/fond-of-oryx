<?php

namespace FondOfOryx\Zed\JellyfishGiftCard\Business;

use FondOfOryx\Zed\JellyfishGiftCard\Business\Api\Adapter\GiftCardApiAdapter;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Api\Adapter\GiftCardApiAdapterInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Exporter\GiftCardExporter;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Exporter\GiftCardExporterInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Filter\LocaleFilter;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Filter\LocaleFilterInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataMapper;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataMapperInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataWrapperMapper;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataWrapperMapperInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardMapper;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardMapperInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardRequestMapper;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardRequestMapperInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailBodyMapper;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailBodyMapperInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailMapper;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailMapperInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailRecipientMapper;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailRecipientMapperInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\RendererInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\TwigRenderer;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGiftCardFacadeInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGlossaryFacadeInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToSalesFacadeInterface;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Service\JellyfishGiftCardToUtilEncodingServiceInterface;
use FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardDependencyProvider;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfOryx\Zed\JellyfishGiftCard\JellyfishGiftCardConfig getConfig()
 */
class JellyfishGiftCardBusinessFactory extends AbstractBusinessFactory
{
    use LoggerTrait;

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Business\Exporter\GiftCardExporterInterface
     */
    public function createGiftCardExport(): GiftCardExporterInterface
    {
        return new GiftCardExporter(
            $this->createJellyfishGiftCardRequestMapper(),
            $this->createJellyfishGiftCardDataWrapperMapper(),
            $this->createGiftCardApiAdapter(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardRequestMapperInterface
     */
    protected function createJellyfishGiftCardRequestMapper(): JellyfishGiftCardRequestMapperInterface
    {
        return new JellyfishGiftCardRequestMapper(
            $this->createLocaleFilter(),
            $this->getGiftCardFacade(),
            $this->getSalesFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Business\Filter\LocaleFilterInterface
     */
    protected function createLocaleFilter(): LocaleFilterInterface
    {
        return new LocaleFilter($this->getConfig());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGiftCardFacadeInterface
     */
    protected function getGiftCardFacade(): JellyfishGiftCardToGiftCardFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishGiftCardDependencyProvider::FACADE_GIFT_CARD);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToSalesFacadeInterface
     */
    protected function getSalesFacade(): JellyfishGiftCardToSalesFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishGiftCardDependencyProvider::FACADE_SALES);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataWrapperMapperInterface
     */
    protected function createJellyfishGiftCardDataWrapperMapper(): JellyfishGiftCardDataWrapperMapperInterface
    {
        return new JellyfishGiftCardDataWrapperMapper($this->createJellyfishGiftCardDataMapper());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardDataMapperInterface
     */
    protected function createJellyfishGiftCardDataMapper(): JellyfishGiftCardDataMapperInterface
    {
        return new JellyfishGiftCardDataMapper($this->createJellyfishGiftCardMapper());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishGiftCardMapperInterface
     */
    protected function createJellyfishGiftCardMapper(): JellyfishGiftCardMapperInterface
    {
        return new JellyfishGiftCardMapper(
            $this->createJellyfishMailMapper(),
            $this->createRenderer(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailMapperInterface
     */
    protected function createJellyfishMailMapper(): JellyfishMailMapperInterface
    {
        return new JellyfishMailMapper(
            $this->createJellyfishMailRecipientMapper(),
            $this->createJellyfishMailBodyMapper(),
            $this->getConfig(),
            $this->getGlossaryFacade(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailRecipientMapperInterface
     */
    protected function createJellyfishMailRecipientMapper(): JellyfishMailRecipientMapperInterface
    {
        return new JellyfishMailRecipientMapper();
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Business\Mapper\JellyfishMailBodyMapperInterface
     */
    protected function createJellyfishMailBodyMapper(): JellyfishMailBodyMapperInterface
    {
        return new JellyfishMailBodyMapper(
            $this->createRenderer(),
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Business\Renderer\RendererInterface
     */
    protected function createRenderer(): RendererInterface
    {
        return new TwigRenderer(
            $this->getProvidedDependency(JellyfishGiftCardDependencyProvider::RENDERER),
        );
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGlossaryFacadeInterface
     */
    protected function getGlossaryFacade(): JellyfishGiftCardToGlossaryFacadeInterface
    {
        return $this->getProvidedDependency(JellyfishGiftCardDependencyProvider::FACADE_GLOSSARY);
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Business\Api\Adapter\GiftCardApiAdapterInterface
     */
    protected function createGiftCardApiAdapter(): GiftCardApiAdapterInterface
    {
        return new GiftCardApiAdapter(
            $this->createHttpClient(),
            $this->getUtilEncodingService(),
            $this->getLogger(),
        );
    }

    /**
     * @return \GuzzleHttp\ClientInterface
     */
    protected function createHttpClient(): HttpClientInterface
    {
        return new Client($this->getConfig()->getHttpClientConfig());
    }

    /**
     * @return \FondOfOryx\Zed\JellyfishGiftCard\Dependency\Service\JellyfishGiftCardToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): JellyfishGiftCardToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(JellyfishGiftCardDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
