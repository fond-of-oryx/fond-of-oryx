<?php

namespace FondOfOryx\Zed\CompanyDeleter\Communication\Console;

use Exception;
use FondOfOryx\Shared\CompanyDeleter\CompanyDeleterConstants;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\CompanyDeleter\Business\CompanyDeleterFacadeInterface getFacade()
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
        $result = [];

        $ids = [];
        if ($input->getOption(static::COMPANY_IDS)) {
            $storeIdsString = $input->getOption(static::COMPANY_IDS);
            $ids = explode(',', $storeIdsString);
        }

        try {
            $result = $this->getFacade()->deleteCompanies($ids);
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

        $successMessage = $this->getSuccessMessage($result);
        if ($successMessage !== '') {
            $messenger->info($successMessage);
        }
        $errorMessage = $this->getErrorMessage($result);
        if ($errorMessage !== '') {
            $messenger->warning($errorMessage);
            $status = static::CODE_SUCCESS;
        }

        return $status;
    }

    /**
     * @param array $result
     *
     * @return string
     */
    protected function getSuccessMessage(array $result): string
    {
        $successCount = $this->getSuccessCount($result);
        if ($successCount === 0) {
            return '';
        }

        return sprintf('Successfully deleted "%s" company entries for following ids: %s', $successCount, implode(',', $this->getSuccessIds($result)));
    }

    /**
     * @param array $result
     *
     * @return string
     */
    protected function getErrorMessage(array $result): string
    {
        $errorCount = $this->getErrorCount($result);
        if ($errorCount === 0) {
            return '';
        }

        return sprintf('"%s" error appeared. Please investigate log files for further information. Could not delete entries for following ids: %s', $errorCount, implode(',', $this->getErrorIds($result)));
    }

    /**
     * @param array $result
     *
     * @return int
     */
    protected function getSuccessCount(array $result): int
    {
        if (array_key_exists(CompanyDeleterConstants::SUCCESS_IDS, $result) && is_array($result[CompanyDeleterConstants::SUCCESS_IDS])) {
            return count($result[CompanyDeleterConstants::SUCCESS_IDS]);
        }

        return 0;
    }

    /**
     * @param array $result
     *
     * @return array
     */
    protected function getSuccessIds(array $result): array
    {
        if (array_key_exists(CompanyDeleterConstants::SUCCESS_IDS, $result) && is_array($result[CompanyDeleterConstants::SUCCESS_IDS])) {
            return $result[CompanyDeleterConstants::SUCCESS_IDS];
        }

        return [];
    }

    /**
     * @param array $result
     *
     * @return array
     */
    protected function getErrorIds(array $result): array
    {
        if (array_key_exists(CompanyDeleterConstants::ERROR_IDS, $result) && is_array($result[CompanyDeleterConstants::ERROR_IDS])) {
            return $result[CompanyDeleterConstants::ERROR_IDS];
        }

        return [];
    }

    /**
     * @param array $result
     *
     * @return int
     */
    protected function getErrorCount(array $result): int
    {
        if (array_key_exists(CompanyDeleterConstants::ERROR_IDS, $result) && is_array($result[CompanyDeleterConstants::ERROR_IDS])) {
            return count($result[CompanyDeleterConstants::ERROR_IDS]);
        }

        return 0;
    }
}
