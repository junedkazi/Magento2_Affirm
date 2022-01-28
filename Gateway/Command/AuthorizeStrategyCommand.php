<?php
/**
 * Affirm
 * NOTICE OF LICENSE
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 *
 * @category  Affirm
 * @package   Affirm
 * @copyright Copyright (c) 2021 Affirm. All rights reserved.
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Affirm\Gateway\Command;

use Magento\Payment\Gateway\Command;
use Magento\Payment\Gateway\CommandInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Sales\Model\Order;

class AuthorizeStrategyCommand implements CommandInterface
{
    /**
     * Pre authorize
     */
    const PRE_AUTHORIZE = 'pre_authorize';

    /**
     * Order authorize
     */
    const ORDER_AUTHORIZE = 'order_authorize';

    /**
     * Command pool
     *
     * @var Command\CommandPoolInterface
     */
    private $commandPool;

    /**
     * Constructor
     *
     * @param Command\CommandPoolInterface $commandPool
     */
    public function __construct(
        Command\CommandPoolInterface $commandPool
    ) {
        $this->commandPool = $commandPool;
    }

    /**
     * Executes command basing on business object
     *
     * @param array $commandSubject
     * @return null|Command\ResultInterface
     * @throws LocalizedException
     */
    public function execute(array $commandSubject)
    {
        $this->commandPool
            ->get(self::PRE_AUTHORIZE)
            ->execute($commandSubject);

        return $this->commandPool
            ->get(self::ORDER_AUTHORIZE)
            ->execute($commandSubject);
    }
}
