<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Communication\Console;

use Exception;
use Generated\Shared\Transfer\RepresentativeCompanyUserCommandTransfer;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfOryx\Zed\RepresentativeCompanyUser\Business\RepresentativeCompanyUserFacadeInterface getFacade()
 */
class RepresentativeCompanyUserTaskRunnerConsole extends Console
{
    /**
     * @var string
     */
    public const COMMAND_NAME = 'representativecompanyuser:run:task';

    /**
     * @var string
     */
    public const DESCRIPTION = 'Runs the RepresentativeCompanyUser task';

    /**
     * @var string
     */
    public const RESOURCE_REPRESENTATIVE_COMPANY_USER = 'resource';

    /**
     * @var string
     */
    public const RESOURCE_REPRESENTATIVE_COMPANY_USER_SHORTCUT = 'r';

    /**
     * @var string
     */
    public const REPRESENTATIVE_COMPANY_USER_IDS = 'ids';

    /**
     * @var string
     */
    public const REPRESENTATIVE_COMPANY_USER_IDS_SHORTCUT = 'i';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->addOption(
            static::RESOURCE_REPRESENTATIVE_COMPANY_USER,
            static::RESOURCE_REPRESENTATIVE_COMPANY_USER_SHORTCUT,
            InputArgument::OPTIONAL,
            sprintf(
                'Available tasks: %s-> %s',
                PHP_EOL,
                implode(PHP_EOL . '-> ', $this->getFacade()->getRegisteredProcessorNames()),
            ),
        );
        $this->addOption(
            static::REPRESENTATIVE_COMPANY_USER_IDS,
            static::REPRESENTATIVE_COMPANY_USER_IDS_SHORTCUT,
            InputArgument::OPTIONAL,
            'Run command only for given ids',
        );

        $this->setName(static::COMMAND_NAME)
            ->setDescription(static::DESCRIPTION);
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
        if ($input->getOption(static::RESOURCE_REPRESENTATIVE_COMPANY_USER)) {
            $resourceString = $input->getOption(static::RESOURCE_REPRESENTATIVE_COMPANY_USER);
            $resources = explode(',', $resourceString);
        }

        $ids = [];
        if ($input->getOption(static::REPRESENTATIVE_COMPANY_USER_IDS)) {
            $idsAsString = $input->getOption(static::REPRESENTATIVE_COMPANY_USER_IDS);
            $ids = explode(',', $idsAsString);
        }

        try {
            $command = (new RepresentativeCompanyUserCommandTransfer())->setIds($ids)->setResources($resources);
            $this->getFacade()->runTask($command);
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
