<?php


class Installer
{
    private array $days;

    public function __construct(array $days)
    {
        foreach ($days as $item)
        {
            $this->days[]= new Info( $item->day->maxtemp_c, $item->day->avgtemp_c,$item->day->condition->text,$item->hour);
        }
    }
    /**
     * @return array
     */
    public function getDays(): array
    {
        return $this->days;
    }
}