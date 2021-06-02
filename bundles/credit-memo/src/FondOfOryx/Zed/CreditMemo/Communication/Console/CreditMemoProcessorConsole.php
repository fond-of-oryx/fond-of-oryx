<?php

namespace FondOfOryx\Zed\CreditMemo\Communication\Console;

use Exception;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\CreditMemo\Business\CreditMemoFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\CreditMemo\Persistence\CreditMemoRepositoryInterface getRepository()
 */
class CreditMemoProcessorConsole extends Console
{
    public const COMMAND_NAME = 'credit-memo:process';
    public const DESCRIPTION = '';
    public const RESOURCE_CREDIT_MEMO_PROCESSOR = 'resource';
    public const RESOURCE_CREDIT_MEMO_PROCESSOR_SHORTCUT = 'r';
    public const CREDIT_MEMO_IDS = 'ids';
    public const CREDIT_MEMO_IDS_SHORTCUT = 'i';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addOption(
            static::RESOURCE_CREDIT_MEMO_PROCESSOR,
            static::RESOURCE_CREDIT_MEMO_PROCESSOR_SHORTCUT,
            InputArgument::OPTIONAL,
            sprintf(
                'Defines the processor resources to use. Available processor: %s-> %s',
                PHP_EOL,
                implode(PHP_EOL . '-> ', array_keys($this->getFacade()->getRegisteredProcessor()))
            )
        );
        $this->addOption(
            static::CREDIT_MEMO_IDS,
            static::CREDIT_MEMO_IDS_SHORTCUT,
            InputArgument::OPTIONAL,
            'Run command only for given credit memo ids'
        );
        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION)
            ->addUsage(sprintf('-%s resource -%s ids', static::RESOURCE_CREDIT_MEMO_PROCESSOR_SHORTCUT, static::CREDIT_MEMO_IDS_SHORTCUT));
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int|null
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $status = static::CODE_SUCCESS;
        $messenger = $this->getMessenger();

        $resources = [];
        if ($input->getOption(static::RESOURCE_CREDIT_MEMO_PROCESSOR)) {
            $resourceString = $input->getOption(static::RESOURCE_CREDIT_MEMO_PROCESSOR);
            $resources = explode(',', $resourceString);
        }

        $ids = [];
        if ($input->getOption(static::CREDIT_MEMO_IDS)) {
            $storeIdsString = $input->getOption(static::CREDIT_MEMO_IDS);
            $ids = explode(',', $storeIdsString);
        }

        try {
            $responseCollection = $this->getFacade()->processCreditMemos($resources, $ids);
        } catch (Exception $exception) {
            $status = static::CODE_ERROR;
            $messenger->error(sprintf(
                'Command %s failt with message: %s%s!',
                static::COMMAND_NAME,
                PHP_EOL,
                $exception->getMessage()
            ));
        }

        $messenger->info(sprintf(
            'You just executed %s!',
            static::COMMAND_NAME
        ));

        return $status;
    }
}
