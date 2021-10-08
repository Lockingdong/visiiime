<?php
namespace App\VO;

class CreateUserSubscriptionVO 
{
    /**
     * @var string $type
     */
    public $type;

    /**
     * @var string $periodStartDate
     */
    public $periodStartDate;

    /**
     * @var int $amount
     */
    public $amount;

    /**
     * @var int $period
     */
    public $period;

    /**
     * @var int $oriAmount|null
     */
    public $oriAmount = null;
}