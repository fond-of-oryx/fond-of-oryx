<?php

namespace FondOfOryx\Zed\RepresentativeCompanyUser\Business\Writer;

use FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface;
use FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface;
use Generated\Shared\Transfer\RepresentativeCompanyUserTransfer;

class RepresentativeCompanyUserWriter implements RepresentativeCompanyUserWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface
     */
    protected $reader;

    /**
     * @var \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Business\Reader\RepresentativeCompanyUserReaderInterface $reader
     * @param \FondOfOryx\Zed\RepresentativeCompanyUser\Persistence\RepresentativeCompanyUserEntityManagerInterface $entityManager
     */
    public function __construct(RepresentativeCompanyUserReaderInterface $reader, RepresentativeCompanyUserEntityManagerInterface $entityManager)
    {
        $this->reader = $reader;
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function write(RepresentativeCompanyUserTransfer $representativeCompanyUserTransfer): RepresentativeCompanyUserTransfer
    {
        return $this->entityManager->createRepresentativeCompanyUser($representativeCompanyUserTransfer);
    }

    /**
     * @param string $uuid
     * @param string $state
     *
     * @return \Generated\Shared\Transfer\RepresentativeCompanyUserTransfer
     */
    public function flagState(string $uuid, string $state): RepresentativeCompanyUserTransfer
    {
        return $this->entityManager->flagState($uuid, $state);
    }
}
