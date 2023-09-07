<?php

namespace FondOfOryx\Zed\PropelPreMigration\Business\Model;

use Exception;
use FondOfOryx\Shared\PropelPreMigration\PropelPreMigrationConstants;
use FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationEntityManagerInterface;
use FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationRepositoryInterface;
use FondOfOryx\Zed\PropelPreMigration\PropelPreMigrationConfig;
use Generated\Shared\Transfer\PropelPreMigrationTransfer;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface;
use Throwable;

class SqlExecutor implements SqlExecutorInterface
{
    protected PropelPreMigrationEntityManagerInterface $entityManager;

    protected PropelPreMigrationRepositoryInterface $repository;

    protected PropelPreMigrationConfig $config;

    protected TransactionHandlerInterface $transactionHandler;

    /**
     * @param \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationEntityManagerInterface $entityManager
     * @param \FondOfOryx\Zed\PropelPreMigration\Persistence\PropelPreMigrationRepositoryInterface $repository
     * @param \FondOfOryx\Zed\PropelPreMigration\PropelPreMigrationConfig $config
     * @param \Spryker\Zed\Kernel\Persistence\EntityManager\TransactionHandlerInterface $transactionHandler
     */
    public function __construct(
        PropelPreMigrationEntityManagerInterface $entityManager,
        PropelPreMigrationRepositoryInterface $repository,
        PropelPreMigrationConfig $config,
        TransactionHandlerInterface $transactionHandler
    ) {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
        $this->config = $config;
        $this->transactionHandler = $transactionHandler;
    }

    /**
     * @param array $sqlFiles
     *
     * @return array
     */
    public function execute(array $sqlFiles): array
    {
        $importDirectory = $this->getSqlImportDirectory();

        if (count($sqlFiles) === 0) {
            $sqlFiles = $this->getSqlFilesFromDirectory($importDirectory);
        }

        $sqlFilesForMigration = $this->repository->getNotMigratedFileNamesByFileNames($sqlFiles);

        return $this->transactionHandler->handleTransaction(
            function () use ($sqlFilesForMigration, $importDirectory) {
                return $this->executeCreateTransaction($sqlFilesForMigration, $importDirectory);
            },
        );
    }

    /**
     * @param array<string> $sqlFilesForMigration
     * @param string $importDirectory
     *
     * @throws \Exception
     *
     * @return array
     */
    protected function executeCreateTransaction(
        array $sqlFilesForMigration,
        string $importDirectory
    ): array {
        $results = [];
        foreach ($sqlFilesForMigration as $sqlFile) {
            $success = false;
            $message = '';
            $fullFilePath = $importDirectory . $sqlFile;
            try {
                $success = $this->entityManager->executePlainSqlFromFile($fullFilePath);
            } catch (Throwable $throwable) {
                $message = $throwable->getMessage();
            }

            $results[] = [
                PropelPreMigrationConstants::KEY_FILE => $sqlFile,
                PropelPreMigrationConstants::KEY_SUCCESS => $success,
                PropelPreMigrationConstants::KEY_MESSAGE => $message,
            ];

            if ($success) {
                $this->entityManager->createPropelPreMigrationEntry(
                    (new PropelPreMigrationTransfer())
                        ->setFile($sqlFile)
                        ->setHash(sha1_file($fullFilePath)),
                );

                continue;
            }

            throw new Exception(sprintf('Could not execute SQL of "%s". Message: %s', $sqlFile, $message));
        }

        return $results;
    }

    /**
     * @throws \Exception
     *
     * @return string
     */
    protected function getSqlImportDirectory(): string
    {
        $sqlImportDirectory = $this->config->getSqlDirectory();

        if (file_exists($sqlImportDirectory) && is_dir($sqlImportDirectory)) {
            return $sqlImportDirectory;
        }

        if (mkdir($sqlImportDirectory) && is_dir($sqlImportDirectory)) {
            return $sqlImportDirectory;
        }

        throw new Exception(sprintf('Import directory "%s" not exists!', $sqlImportDirectory));
    }

    /**
     * @param string $importDirectory
     *
     * @return array<string>
     */
    protected function getSqlFilesFromDirectory(string $importDirectory): array
    {
        $sqlFiles = glob($importDirectory . '*.{sql}', GLOB_BRACE);

        if (!is_array($sqlFiles)) {
            $sqlFiles = [];
        }

        $sqlFiles = $this->removeStaticDirectoryFromFilePath($sqlFiles, $importDirectory);

        return $this->filterFiles($sqlFiles);
    }

    /**
     * @param array<string> $sqlFiles
     *
     * @return array<string>
     */
    protected function filterFiles(array $sqlFiles): array
    {
        foreach ($sqlFiles as $index => $file) {
            if (preg_match($this->config->getSqlFilePattern(), $file)) {
                continue;
            }

            unset($sqlFiles[$index]);
        }

        return $sqlFiles;
    }

    /**
     * @param array $sqlFiles
     * @param string $importDirectory
     *
     * @return array
     */
    protected function removeStaticDirectoryFromFilePath(array $sqlFiles, string $importDirectory): array
    {
        $cleaned = [];
        foreach ($sqlFiles as $file) {
            $cleaned[] = str_replace($importDirectory, '', $file);
        }

        return $cleaned;
    }
}
