<?php

namespace FondOfOryx\Zed\JellyfishCreditMemo\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Business\JellyfishCreditMemoFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Persistence\JellyfishCreditMemoRepositoryInterface getRepository()
 * @method \FondOfOryx\Zed\JellyfishCreditMemo\Communication\JellyfishCreditMemoCommunicationFactory getFactory()
 */
class JellyfishCreditMemoConsole extends Console
{
    /**
     * @var string
     */
    protected const COMMAND_NAME = 'jellyfish:credit-memo:export';

    /**
     * @var string
     */
    protected const DESCRIPTION = 'Exports credit memo entries to jellyfish';

    /**
     * @return void
     */
    protected function configure()
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
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getFacade()->exportCreditMemos();

        return 0;
    }
}
