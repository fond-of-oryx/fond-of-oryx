<?php

namespace FondOfOryx\Zed\CompanyUserArchive\Business\Writer;

use Exception;
use FondOfOryx\Zed\CompanyUserArchive\Persistence\CompanyUserArchiveEntityManagerInterface;
use Generated\Shared\Transfer\CompanyUserArchiveTransfer;
use Psr\Log\LoggerInterface;
use Spryker\Zed\Kernel\Persistence\EntityManager\TransactionTrait;

class CompanyUserArchiveWriter implements CompanyUserArchiveWriterInterface
{
    use TransactionTrait;

    /**
     * @var \FondOfOryx\Zed\CompanyUserArchive\Persistence\CompanyUserArchiveEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @param \FondOfOryx\Zed\CompanyUserArchive\Persistence\CompanyUserArchiveEntityManagerInterface $entityManager
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        CompanyUserArchiveEntityManagerInterface $entityManager,
        LoggerInterface $logger
    ) {
        $this->entityManager = $entityManager;
        $this->logger = $logger;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserArchiveTransfer $companyUserArchiveTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserArchiveTransfer
     */
    public function createCompanyUserArchive(
        CompanyUserArchiveTransfer $companyUserArchiveTransfer
    ): CompanyUserArchiveTransfer {
        try {
            $companyUserArchiveTransfer = $this->getTransactionHandler()->handleTransaction(
                function () use ($companyUserArchiveTransfer) {
                    return $this->executeSaveTransaction($companyUserArchiveTransfer);
                },
            );
        } catch (Exception $exception) {
            $this->logger->error($exception->getMessage(), $exception->getTrace());
        }

        return $companyUserArchiveTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\CompanyUserArchiveTransfer $companyUserArchiveTransfer
     *
     * @return \Generated\Shared\Transfer\CompanyUserArchiveTransfer
     */
    protected function executeSaveTransaction(
        CompanyUserArchiveTransfer $companyUserArchiveTransfer
    ): CompanyUserArchiveTransfer {
        return $this->entityManager->createCompanyUserArchive($companyUserArchiveTransfer);
    }
}
