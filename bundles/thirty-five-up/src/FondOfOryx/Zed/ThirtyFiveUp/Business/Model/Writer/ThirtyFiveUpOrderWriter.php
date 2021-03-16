<?php

namespace FondOfOryx\Zed\ThirtyFiveUp\Business\Model\Writer;

use FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface;
use Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer;

class ThirtyFiveUpOrderWriter implements ThirtyFiveUpOrderWriterInterface
{
    /**
     * @var \FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param \FondOfOryx\Zed\ThirtyFiveUp\Persistence\ThirtyFiveUpEntityManagerInterface $entityManager
     */
    public function __construct(ThirtyFiveUpEntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function create(ThirtyFiveUpOrderTransfer $orderTransfer): ThirtyFiveUpOrderTransfer
    {
        return $this->entityManager->createThirtyFiveUpOrder($orderTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer $orderTransfer
     *
     * @return \Generated\Shared\Transfer\ThirtyFiveUpOrderTransfer
     */
    public function update(ThirtyFiveUpOrderTransfer $orderTransfer): ThirtyFiveUpOrderTransfer
    {
        return $this->entityManager->updateThirtyFiveUpOrder($orderTransfer);
    }
}
