<?php

class Info
{
    private float $maxTemp;
    private float $avgTemp;
    private string $condition;
    private array $hours;
    private string $date;

    public function __construct(string $date,float $maxTemp, float $avgTemp, string $condition, array $hours)
    {
        $this->maxTemp = $maxTemp;
        $this->avgTemp = $avgTemp;
        $this->condition = $condition;
        $this->hours = $hours;
        $this->date = $date;
    }

    /**
     * @return float
     */
    public function getAvgTemp(): float
    {
        return $this->avgTemp;
    }

    /**
     * @return string
     */
    public function getCondition(): string
    {
        return $this->condition;
    }

    /**
     * @return float
     */
    public function getMaxTemp(): float
    {
        return $this->maxTemp;
    }

    /**
     * @return array
     */
    public function getHours(): array
    {
        return $this->hours;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }
}