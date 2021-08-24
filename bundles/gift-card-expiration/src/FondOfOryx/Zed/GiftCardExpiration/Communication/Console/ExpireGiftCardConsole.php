<?php

namespace FondOfOryx\Zed\GiftCardExpiration\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\GiftCardExpiration\Business\GiftCardExpirationFacadeInterface getFacade()
 */
class ExpireGiftCardConsole extends Console
{
    private const COMMAND_NAME = 'gift-card:expire';
    private const DESCRIPTION = 'Expires gift cards.';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription(static::DESCRIPTION);

        parent::configure();
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->getFacade()->expireGiftCards();

        return 0;
    }
}
