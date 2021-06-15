<?php

namespace FondOfOryx\Zed\JellyfishBuffer\Business\Buffer;

use FondOfOryx\Zed\JellyfishBuffer\Persistence\JellyfishBufferEntityManagerInterface;
use Generated\Shared\Transfer\JellyfishOrderTransfer;

class JellyfishBufferOrder implements JellyfishBufferOrderInterface
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
     * @param \Generated\Shared\Transfer\JellyfishOrderTransfer $jellyfishOrderTransfer
     * @param array $options
     *
     * @return void
     */
    public function bufferOrder(
        JellyfishOrderTransfer $jellyfishOrderTransfer,
        array $options
    ): void {
        $this->jellyfishBufferEntityManager
            ->createExportedOrder(
                $jellyfishOrderTransfer,
                $options
            );
    }
}
