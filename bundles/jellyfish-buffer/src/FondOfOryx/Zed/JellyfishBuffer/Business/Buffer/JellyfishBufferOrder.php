<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business\Buffer;

use Exception;
use FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;
use Spryker\Shared\Kernel\Transfer\AbstractTransfer;

class JellyfishBufferOrder implements JellyfishBufferInterface
{
    /**
     * @var \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface
     */
    protected $jellyfishBufferEntityManager;

    /**
     * @param \FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface $jellyfishBufferEntityManager
     */
    public function __construct(JellyfishBufferEntityManagerInterface $jellyfishBufferEntityManager)
    {
        $this->jellyfishBufferEntityManager = $jellyfishBufferEntityManager;
    }

    /**
     * @param \Spryker\Shared\Kernel\Transfer\AbstractTransfer $transfer
     * @param array $options
     *
     * @throws \Exception
     *
     * @return void
     */
    public function buffer(AbstractTransfer $transfer, array $options): void
    {
        if (($transfer instanceof JellyfishOrderTransfer) === false) {
            throw new Exception(sprintf('Transfer has to be instance of "%s" instead of "%s"', JellyfishOrderTransfer::class, get_class($transfer)));
        }

        $this->jellyfishBufferEntityManager
            ->createExportedOrder(
                $transfer,
                $options,
            );
    }
}
