<?php

namespace FondOfOryx\Zed\SplittableQuote\Business\Splitter;

use ArrayObject;
use FondOfOryx\Zed\SplittableQuote\Dependency\Facade\SplittableQuoteToCalculationFacadeInterface;
use FondOfOryx\Zed\SplittableQuote\SplittableQuoteConfig;
use Generated\Shared\Transfer\ItemTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

class QuoteSplitter implements QuoteSplitterInterface
{
    /**
     * @var \FondOfOryx\Zed\SplittableQuote\Dependency\Facade\SplittableQuoteToCalculationFacadeInterface
     */
    protected $calculationFacade;

    /**
     * @var \FondOfOryx\Zed\SplittableQuote\SplittableQuoteConfig
     */
    protected $config;

    /**
     * @var array<\FondOfOryx\Zed\SplittableQuoteExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface>
     */
    protected $splittedQuoteExpanderPlugins;

    /**
     * @param \FondOfOryx\Zed\SplittableQuote\Dependency\Facade\SplittableQuoteToCalculationFacadeInterface $calculationFacade
     * @param \FondOfOryx\Zed\SplittableQuote\SplittableQuoteConfig $config
     * @param array<\FondOfOryx\Zed\SplittableQuoteExtension\Dependency\Plugin\SplittedQuoteExpanderPluginInterface> $splittedQuoteExpanderPlugins
     */
    public function __construct(
        SplittableQuoteToCalculationFacadeInterface $calculationFacade,
        SplittableQuoteConfig $config,
        array $splittedQuoteExpanderPlugins = []
    ) {
        $this->calculationFacade = $calculationFacade;
        $this->config = $config;
        $this->splittedQuoteExpanderPlugins = $splittedQuoteExpanderPlugins;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return array<string, \Generated\Shared\Transfer\QuoteTransfer>
     */
    public function split(QuoteTransfer $quoteTransfer): array
    {
        $getterMethod = $this->getGetterMethod();

        if ($getterMethod === null) {
            return ['*' => $quoteTransfer];
        }

        $quoteTransfers = [];

        foreach ($quoteTransfer->getItems() as $itemTransfer) {
            $splitItemAttributeValue = $itemTransfer->$getterMethod() ?? '*';

            if (!isset($quoteTransfers[$splitItemAttributeValue])) {
                $quoteTransfers[$splitItemAttributeValue] = $this->cloneQuote($quoteTransfer);
            }

            $quoteTransfers[$splitItemAttributeValue]->addItem($itemTransfer);
        }

        return $this->expandAndRecalculateSplittedQuotes($quoteTransfers);
    }

    /**
     * @return string|null
     */
    protected function getGetterMethod(): ?string
    {
        $splitItemAttribute = $this->config->getSplitItemAttribute();

        if ($splitItemAttribute === null) {
            return null;
        }

        $getterMethod = sprintf(
            'get%s',
            str_replace(' ', '', ucwords(str_replace('_', ' ', $splitItemAttribute))),
        );

        if (!method_exists(ItemTransfer::class, $getterMethod)) {
            return null;
        }

        return $getterMethod;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\QuoteTransfer
     */
    protected function cloneQuote(QuoteTransfer $quoteTransfer): QuoteTransfer
    {
        return (new QuoteTransfer())->fromArray($quoteTransfer->toArray(), true)
            ->setIdQuote(null)
            ->setUuid(null)
            ->setItems(new ArrayObject())
            ->setIsDefault(false);
    }

    /**
     * @param array<string, \Generated\Shared\Transfer\QuoteTransfer> $splittedQuoteTransfers
     *
     * @return array<string, \Generated\Shared\Transfer\QuoteTransfer>
     */
    protected function expandAndRecalculateSplittedQuotes(array $splittedQuoteTransfers): array
    {
        foreach ($splittedQuoteTransfers as $key => $splittedQuoteTransfer) {
            foreach ($this->splittedQuoteExpanderPlugins as $splittedQuoteExpanderPlugin) {
                $splittedQuoteTransfers[$key] = $this->calculationFacade->recalculateQuote(
                    $splittedQuoteTransfer,
                    false,
                );

                $splittedQuoteTransfers[$key] = $splittedQuoteExpanderPlugin->expand($splittedQuoteTransfers[$key]);
            }

            $splittedQuoteTransfers[$key] = $this->calculationFacade->recalculateQuote(
                $splittedQuoteTransfers[$key],
                false,
            );
        }

        return $splittedQuoteTransfers;
    }
}
