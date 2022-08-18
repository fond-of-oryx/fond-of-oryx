<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\VertigoPriceProductPriceListFacadeInterface getFacade()
 */
class VertigoPricesRequestConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'vertigo:prices:request';

    /**
     * @var string
     */
    public const COMMAND_DESCRIPTION = 'Will request price list prices for given sku.';

    /**
     * @var string
     */
    public const ARGUMENT_SKU = 'sku';

    /**
     * @return void
     */
    protected function configure(): void
    {
        parent::configure();

        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::COMMAND_DESCRIPTION);

        $this->addArgument(static::ARGUMENT_SKU, InputArgument::REQUIRED, 'Concrete product sku.');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $sku = $this->input->getArgument(static::ARGUMENT_SKU);

        $this->getFacade()->requestPriceProductPriceListBySku($sku);

        return static::CODE_SUCCESS;
    }
}
