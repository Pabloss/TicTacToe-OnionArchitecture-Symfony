<?php
declare(strict_types=1);

namespace App\AppCore\DomainModel\Game\Player\Type;

use App\AppCore\DomainModel\Game\Exception\NotAllowedTypeValue;

/**
 * Class PlayerType
 * @package App\AppCore\DomainModel\Game\Player\Type
 */
class PlayerType
{
    const AI_TYPE = 'AI';
    const REAL_TYPE = 'Real';

    /**
     * @var
     */
    private $value;

    /**
     * PlayerType constructor.
     * @param $value
     * @throws NotAllowedTypeValue
     */
    public function __construct($value)
    {
        if (!in_array(
            $value,
            [
                self::AI_TYPE,
                self::REAL_TYPE,
            ]
        )) {
            throw new NotAllowedTypeValue();
        }
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function value()
    {
        return $this->value;
    }
}
