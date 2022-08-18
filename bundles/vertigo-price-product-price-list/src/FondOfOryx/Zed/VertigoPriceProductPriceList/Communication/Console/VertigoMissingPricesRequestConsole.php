<?php

namespace FondOfOryx\Zed\VertigoPriceProductPriceList\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @codeCoverageIgnore
 *
 * @method \FondOfOryx\Zed\VertigoPriceProductPriceList\Business\VertigoPriceProductPriceListFacadeInterface getFacade()
 */
class VertigoMissingPricesRequestConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'vertigo:missing-prices:request';

    /**
     * @var string
     */
    public const COMMAND_DESCRIPTION = 'Will request missing price list prices.';

    /**
     * @return void
     */
    protected function configure(): void
    {
        parent::configure();

        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::COMMAND_DESCRIPTION);
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->getFacade()->requestMissingPriceProductPriceList();

        return static::CODE_SUCCESS;
    }
}
