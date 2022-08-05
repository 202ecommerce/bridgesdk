<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * PHP version 5.6+
 *
 * @category  BridgeSDK
 * @package   Ecommercebridgesdk
 * @author    202-ecommerce <tech@202-ecommerce.com>
 * @copyright 2022 (c) 202-ecommerce
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 * @link      https://docs.bridgeapi.io/
 */

namespace BridgeSDK\Model\Payment;

use BridgeSDK\Model\AbstractModel;
use BridgeSDK\Model\ArrayCollection;
use InvalidArgumentException;

class Payment extends AbstractModel
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $status;

    /**
     * @var string
     */
    private $statusReason;

    /**
     * @var int
     */
    private $bankId;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @var string
     */
    private $updatedAt;

    /**
     * @var PaymentUser
     */
    private $user;

    /**
     * @var ArrayCollection<Transaction>
     */
    private $transactions;

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return Payment
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return Payment
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatusReason()
    {
        return $this->statusReason;
    }

    /**
     * @param string $statusReason
     *
     * @return Payment
     */
    public function setStatusReason($statusReason)
    {
        if (true === \is_string($statusReason)) {
            $this->statusReason = $statusReason;

            return $this;
        }

        throw new InvalidArgumentException(
            'Status reason must be a string '.\gettype($statusReason).' is given.'
        );
    }

    /**
     * @return int
     */
    public function getBankId()
    {
        return $this->bankId;
    }

    /**
     * @param int $bankId
     *
     * @return Payment
     */
    public function setBankId($bankId)
    {
        if (true === \is_int($bankId)) {
            $this->bankId = $bankId;

            return $this;
        }

        throw new InvalidArgumentException(
            'Bank id must be an int '.\gettype($bankId).' is given.'
        );
    }

    /**
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param string $createdAt
     *
     * @return Payment
     */
    public function setCreatedAt($createdAt)
    {
        if (true === \is_string($createdAt)) {
            $this->createdAt = $createdAt;

            return $this;
        }

        throw new InvalidArgumentException(
            'Created at must be a string '.\gettype($createdAt).' is given.'
        );
    }

    /**
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param string $updatedAt
     *
     * @return Payment
     */
    public function setUpdatedAt($updatedAt)
    {
        if (true === \is_string($updatedAt)) {
            $this->updatedAt = $updatedAt;

            return $this;
        }

        throw new InvalidArgumentException(
            'Updated at must be a string '.\gettype($updatedAt).' is given.'
        );
    }

    /**
     * @return PaymentUser
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param PaymentUser $user
     *
     * @return Payment
     */
    public function setUser($user)
    {
        if ($user instanceof PaymentUser) {
            $this->user = $user;

            return $this;
        }

        throw new InvalidArgumentException(
            'User must be a string '.\gettype($user).' is given.'
        );
    }

    /**
     * @return ArrayCollection<Transaction>
     */
    public function getTransactions()
    {
        return $this->transactions;
    }

    /**
     * @param ArrayCollection<Transaction> $transactions
     *
     * @return Payment
     */
    public function setTransactions($transactions)
    {
        if ($transactions instanceof ArrayCollection) {
            $this->transactions = $transactions;

            return $this;
        }

        throw new InvalidArgumentException(
            'Transactions must be an ArrayCollection '.\gettype($transactions).' is given.'
        );
    }

    /**
     * hydrate from array.
     *
     * @param array<mixed> $content
     *
     * @return self
     */
    public function hydrate(array $content)
    {
        $setterName = get_class_methods(static::class);
        foreach ($setterName as $value) {
            if ('set' === substr($value, 0, 3)) {
                $key = lcfirst(substr($value, 3, \strlen($value)));
                $apiKey = $this->transformToPascalCase($key);
                if (isset($content[$apiKey])) {
                    switch ($key) {
                        case 'user':
                            $this->{$value}((new PaymentUser())->hydrate($content[$apiKey]));

                            break;

                        case 'transactions':
                            $collection = new ArrayCollection();
                            foreach ($content[$apiKey] as $transaction) {
                                $collection->append((new Transaction())->hydrate($transaction));
                            }
                            $this->transactions = $collection;

                            break;

                        default:
                            $this->{$value}($content[$apiKey]);
                    }
                }
            }
        }

        return $this;
    }
}
