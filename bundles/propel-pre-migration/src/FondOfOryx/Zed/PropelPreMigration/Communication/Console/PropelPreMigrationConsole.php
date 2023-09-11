<?php

namespace FondOfOryx\Zed\PropelPreMigration\Communication\Console;

use FondOfOryx\Shared\PropelPreMigration\PropelPreMigrationConstants;
use Spryker\Shared\Log\LoggerTrait;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\PropelPreMigration\Business\PropelPreMigrationFacadeInterface getFacade()
 */
class PropelPreMigrationConsole extends Console
{
    use LoggerTrait;

    /**
     * @var string
     */
    public const COMMAND_NAME = 'propel-pre-migrate:migrate';

    /**
     * @var string
     */
    public const COMMAND_DESCRIPTION = 'Executes custom sql from files or all in directory';

    /**
     * @var string
     */
    public const RESOURCE_FILES_OPTION = 'files';

    /**
     * @var string
     */
    public const RESOURCE_FILES_OPTION_SHORTCUT = 'f';

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription(static::COMMAND_DESCRIPTION);

        $this->addOption(
            static::RESOURCE_FILES_OPTION,
            static::RESOURCE_FILES_OPTION_SHORTCUT,
            InputArgument::OPTIONAL,
            'Defines the filenames. Without all files in dir will be migrated!',
        );

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
        $files = [];
        if ($input->getOption(static::RESOURCE_FILES_OPTION)) {
            $file = $input->getOption(static::RESOURCE_FILES_OPTION);
            $files = explode(',', $file);
        }

        $result = $this->getFacade()->execute($files);

        $this->printImporterReport($result);

        foreach ($result as $resultByFile) {
            if ($resultByFile[PropelPreMigrationConstants::KEY_SUCCESS] === false) {
                return 1;
            }
        }

        return 0;
    }

    /**
     * @param array $data
     *
     * @return void
     */
    private function printImporterReport(array $data): void
    {
        $messageTemplateSuccess = PHP_EOL . '<fg=white>'
            . 'File: <fg=green>%s</>' . PHP_EOL
            . 'Success: <fg=green>true</>' . PHP_EOL;

        $messageTemplateFailure = PHP_EOL . '<fg=white>'
            . 'File: <fg=red>%s</>' . PHP_EOL
            . 'Success: <fg=red>false</>' . PHP_EOL
            . 'Message: <fg=red>%s</>' . PHP_EOL;

        foreach ($data as $file) {
            if ($file[PropelPreMigrationConstants::KEY_SUCCESS] === true) {
                $this->info(sprintf(
                    $messageTemplateSuccess,
                    $file[PropelPreMigrationConstants::KEY_FILE],
                ));

                continue;
            }

            $this->info(sprintf(
                $messageTemplateFailure,
                $file[PropelPreMigrationConstants::KEY_FILE],
                $file[PropelPreMigrationConstants::KEY_MESSAGE],
            ));
        }
    }
}
