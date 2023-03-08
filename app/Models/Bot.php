<?php

namespace App\Models;

class Bot
{
    const DIR_NORTH = 0;
    const DIR_EAST  = 1;
    const DIR_SOUTH = 2;
    const DIR_WEST  = 3;

    /** @var integer Represents x coordinate */
    private $x;

    /** @var integer Represents y coordinate */
    private $y;

    /** @var integer Represents the currently facing direction */
    private $dir;

    /**
     * Class Constructor that initializes the bot.
     *
     * @param integer $x   The initial x coordinate.
     * @param integer $y   The initial y coordinate.
     * @param integer $dir The initial direction.
     */
    public function __construct(int $x = 0, int $y = 0, int $dir = 0)
    {
        $this->x = $x;
        $this->y = $y;

        $this->dir = $dir;
    }

    /**
     * Rotate right (clockwise),
     *
     * @return Bot
     */
    public function turnRight(): Bot
    {
        // Since we have incremental sequence clockwise, just add 1
        // but check it never gets past WEST (3).
        $this->dir += 1;

        if ($this->dir > self::DIR_WEST) {
            $this->dir = self::DIR_NORTH;
        }

        return $this;
    }

    /**
     * Rotate left (anticlockwise),
     *
     * @return Bot
     */
    public function turnLeft(): Bot
    {
        // Since we have decremental sequence anticlockwise, just subtract 1
        // but check it never gets below NORTH (0).
        $this->dir -= 1;

        if ($this->dir < self::DIR_NORTH) {
            $this->dir = self::DIR_WEST;
        }

        return $this;
    }

    /**
     * Move the bot by given step(s).
     *
     * @param  integer $step
     *
     * @return Bot
     */
    public function walk(int $step = 1): Bot
    {
        switch ($this->dir) {
            case self::DIR_NORTH;
                $this->y += $step;
                break;

            case self::DIR_EAST;
                $this->x += $step;
                break;

            case self::DIR_SOUTH;
                $this->y -= $step;
                break;

            case self::DIR_WEST;
                $this->x -= $step;
                break;
        }

        return $this;
    }

    /**
     * Get x coordinate.
     *
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * Get y coordinate.
     *
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * Get Direction.
     *
     * @return int
     */
    public function getDir(): int
    {
        return $this->dir;
    }

    /**
     * Get the coordinates and direction.
     *
     * @return array
     */
    public function getPosition(): array
    {
        $dirs = ['North', 'East', 'South', 'West'];

        return [
            'x' => $this->x,
            'y' => $this->y,
            'direction' => $dirs[$this->dir],
        ];
    }
}
