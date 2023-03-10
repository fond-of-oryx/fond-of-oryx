<?php

namespace FondOfOryx\Zed\CompanyDeleter\Communication\Console;

use Exception;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\CompanyDeleter\Business\CompanyDeleterFacadeInterface getFacade()
 * @method \FondOfOryx\Zed\CompanyDeleter\Persistence\CompanyDeleterRepositoryInterface getRepository()
 */
class CompanyDeleterConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'company:delete';

    /**
     * @var string
     */
    public const DESCRIPTION = '';

    /**
     * @var string
     */
    public const COMPANY_IDS = 'ids';

    /**
     * @var string
     */
    public const COMPANY_IDS_SHORTCUT = 'i';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addOption(
            static::COMPANY_IDS,
            static::COMPANY_IDS_SHORTCUT,
            InputOption::VALUE_REQUIRED,
            'Run command for given company ids',
        );
        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION)
            ->addUsage(sprintf('-%s ids (comma separated)', static::COMPANY_IDS_SHORTCUT));
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

        $ids = [];
        if ($input->getOption(static::COMPANY_IDS)) {
            $storeIdsString = $input->getOption(static::COMPANY_IDS);
            $ids = explode(',', $storeIdsString);
        }

        try {
            $this->getFacade()->deleteCompanies($ids);
        } catch (Exception $exception) {
            $status = static::CODE_ERROR;
            $messenger->error(sprintf(
                'Command %s failt with message: %s%s!',
                static::COMMAND_NAME,
                PHP_EOL,
                $exception->getMessage(),
            ));
        }

        $messenger->info(sprintf(
            'You just executed %s!',
            static::COMMAND_NAME,
        ));

        return $status;
    }
}
