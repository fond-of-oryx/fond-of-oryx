<?php

namespace FondOfOryx\Zed\JellyfishGiftCard;

use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGiftCardFacadeBridge;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToGlossaryFacadeBridge;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Facade\JellyfishGiftCardToSalesFacadeBridge;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Renderer\JellyfishGiftCardToRendererBridge;
use FondOfOryx\Zed\JellyfishGiftCard\Dependency\Service\JellyfishGiftCardToUtilEncodingServiceBridge;
use Spryker\Shared\Kernel\ContainerInterface;
use Spryker\Zed\Glossary\Communication\Plugin\TwigTranslatorPlugin;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

class JellyfishGiftCardDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_GIFT_CARD = 'FACADE_GIFT_CARD';
    public const FACADE_GLOSSARY = 'FACADE_GLOSSARY';
    public const FACADE_SALES = 'FACADE_SALES';
    public const RENDERER = 'RENDERER';
    public const SERVICE_TWIG = 'SERVICE_TWIG';
    public const SERVICE_UTIL_ENCODING = 'SERVICE_UTIL_ENCODING';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container): Container
    {
        $container = parent::provideBusinessLayerDependencies($container);

        $container = $this->addGiftCardFacade($container);
        $container = $this->addGlossaryFacade($container);
        $container = $this->addRenderer($container);
        $container = $this->addSalesFacade($container);

        return $this->addUtilEncodingService($container);
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGiftCardFacade(Container $container): Container
    {
        $container[static::FACADE_GIFT_CARD] = static function (Container $container) {
            return new JellyfishGiftCardToGiftCardFacadeBridge(
                $container->getLocator()->giftCard()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addGlossaryFacade(Container $container): Container
    {
        $container[static::FACADE_SALES] = static function (Container $container) {
            return new JellyfishGiftCardToGlossaryFacadeBridge(
                $container->getLocator()->glossary()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addSalesFacade(Container $container): Container
    {
        $container[static::FACADE_SALES] = static function (Container $container) {
            return new JellyfishGiftCardToSalesFacadeBridge(
                $container->getLocator()->sales()->facade()
            );
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addRenderer(Container $container): Container
    {
        $container[static::RENDERER] = static function (ContainerInterface $container) {
            $twig = $container->getApplicationService(static::SERVICE_TWIG);

            if (!$twig->hasExtension(TwigTranslatorPlugin::class)) {
                $translator = new TwigTranslatorPlugin();
                $twig->addExtension($translator);
            }

            return new JellyfishGiftCardToRendererBridge($twig);
        };

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addUtilEncodingService(Container $container): Container
    {
        $container[static::SERVICE_UTIL_ENCODING] = static function (Container $container) {
            return new JellyfishGiftCardToUtilEncodingServiceBridge(
                $container->getLocator()->utilEncoding()->service()
            );
        };

        return $container;
    }
}
