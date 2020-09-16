<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class BetweenFromToDate implements Rule
{
    /**
     * @var string
     */
    protected $to = '';

    /**
     * @var null
     */
    protected static $defaultTimezone = null;

    /**
     * @author : Phi .
     * Create a new rule instance.
     * BetweenFromToDate constructor.
     * @param string $to
     * @param null $timezone
     */
    public function __construct($to = '',$timezone = null)
    {
        $this->to = $to;
        if ($timezone != null) {
            static::setTimezone(
                new \DateTime('@' . strtotime($this->to)),
                $timezone
            );
        }
    }

    /**
     * Internal method to set the time zone on a DateTime.
     *
     * @param \DateTime $dt
     * @param string|null $timezone
     *
     * @return \DateTime
     */
    private static function setTimezone(\DateTime $dt, $timezone)
    {
        return $dt->setTimezone(new \DateTimeZone(static::resolveTimezone($timezone)));
    }

    /**
     * @param string|null $timezone
     * @return null|string
     */
    private static function resolveTimezone($timezone)
    {
        return ((null === $timezone) ? ((null === static::$defaultTimezone) ? date_default_timezone_get() : static::$defaultTimezone) : $timezone);
    }

    /**
     * @author : Phi .
     * @param string|float|int $max
     * @return int|false
     */
    protected static function getMaxTimestamp($max = 'now')
    {
        if (is_numeric($max)) {
            return (int) $max;
        }

        if ($max instanceof \DateTime) {
            return $max->getTimestamp();
        }

        return strtotime(empty($max) ? 'now' : $max);
    }

    /**
     * @author : Phi .
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (!empty($this->to)) {
            $startTimestamp = strtotime($value);
            $endTimestamp = static::getMaxTimestamp($this->to);

            if ($startTimestamp > $endTimestamp) {
                return false;
            }
        }

        return true;
    }

    /**
     * @author : Phi .
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '開催期間は開始日＜終了日である必要があります。';
    }
}
