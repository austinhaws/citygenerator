<?php

namespace App\Http\Controllers\CityGen\Services;

use App\Http\Common\Services\BaseService;
use App\Http\Controllers\CityGen\Models\City\City;
use App\Http\Controllers\CityGen\Models\City\Layout\LayoutCell;
use App\Http\Controllers\CityGen\Models\City\Layout\LayoutMap;

class ShowLayoutService extends BaseService
{
    const FILLER = 'filler';
    const BLANK_WALL = 'blankWall';
    const HORIZONTAL_WALL = 'horizontalWall';
    const VERTICAL_WALL = 'verticalWall';
    const CROSS_WALL = 'crossWall';
    const DOWN_WALL = 'downWall';
    const RIGHT_WALL = 'rightWall';
    const LEFT_WALL = 'leftWall';
    const UP_WALL = 'upWall';
    const TOP_LEFT_WALL = 'topLeftWall';
    const TOP_RIGHT_WALL = 'topRightWall';
    const BOTTOM_LEFT_WALL = 'bottomLeftWall';
    const BOTTOM_RIGHT_WALL = 'bottomRightWall';

    public function showLayout(City $city)
    {
        // give each ward a symbol
        $wardMap = [];
        foreach ($city->wards as $ward) {
            $ward->symbol = $this->wardIdToSymbol($ward->id);
            $wardMap[$ward->id] = $ward;
        }

        return array_map(function ($cellRow, $y) use ($city, $wardMap) {
                $keys = array_keys($cellRow);
                $consts = [
                    self::FILLER => ' ',
                    self::BLANK_WALL => ' ',
                    self::HORIZONTAL_WALL => '─',
                    self::VERTICAL_WALL => '│',
                    self::CROSS_WALL => '┼',
                    self::DOWN_WALL => '┬',
                    self::RIGHT_WALL => '├',
                    self::LEFT_WALL => '┤',
                    self::UP_WALL => '┴',
                    self::TOP_LEFT_WALL => '┌',
                    self::TOP_RIGHT_WALL => '┐',
                    self::BOTTOM_LEFT_WALL => '└',
                    self::BOTTOM_RIGHT_WALL => '┘',
                ];

                $layers = [];
                if ($y === 0) {
                    $layers[] = array_map(function ($cell, $x) use ($consts, $city, $y) {
                        $output = '';
                        if ($x === 0) {
                            $output .= $this->lineForCorner($x, $y, 1, $city, $consts);
                        }
                        $output .= $cell->walls[LayoutMap::DIRECTION_UP] ? $consts[self::HORIZONTAL_WALL] : $consts[self::BLANK_WALL];
                        $output .= $this->lineForCorner($x, $y, 2, $city, $consts);
                        return $output;
                    }, $cellRow, $keys);
                }

                $layers[] = array_map(function ($cell, $x) use ($consts, $wardMap) {
                    $output = '';
                    if ($x === 0) {
                        $output .= $cell->walls[LayoutMap::DIRECTION_LEFT] ? $consts[self::VERTICAL_WALL] : $consts[self::BLANK_WALL];
                    }
                    $output .= $wardMap[$cell->wardId]->symbol;
                    $output .= $cell->walls[LayoutMap::DIRECTION_RIGHT] ? $consts[self::VERTICAL_WALL] : $consts[self::BLANK_WALL];
                    return $output;
                }, $cellRow, $keys);

                $layers[] = array_map(function ($cell, $x) use ($consts, $y, $city) {
                    $output = '';
                    if ($x === 0) {
                        $output .= $this->lineForCorner($x, $y, 4, $city, $consts);
                    }
                    $output .= $cell->walls[LayoutMap::DIRECTION_DOWN] ? $consts[self::HORIZONTAL_WALL] : $consts[self::BLANK_WALL];
                    $output .= $this->lineForCorner($x, $y, 3, $city, $consts);
                    return $output;
                }, $cellRow, $keys);

                return array_map(function ($layer) {
                    return join('', $layer);
                }, $layers);
            }, $city->layout->cells, array_keys($city->layout->cells));
    }


    /**
     * @param $wardId
     * @return string
     */
    private function wardIdToSymbol($wardId)
    {
        if ($wardId === null) {
            $output = '◊';
        } else if ($wardId <= 26) {
            $output = chr(ord('a') + $wardId - 1);
        } else if ($wardId <= 52) {
            $output = chr(ord('A') + ($wardId - 26) - 1);
        } else if ($wardId == 62) {
            $output = chr(ord('0') + ($wardId - 52) - 1);
        } else {
            throw new \Exception('Too many wards: ' . $wardId);
        }
        return $output;
    }


    /**
     * @param int $x
     * @param int $y
     * @param City $city
     * @return LayoutCell[][]
     */
    private function cellNeighbors(int $x, int $y, City $city)
    {
        return [
            [
                $city->layout->getCell($x - 1, $y - 1),
                $city->layout->getCell($x, $y - 1),
                $city->layout->getCell($x + 1, $y - 1),
            ],
            [
                $city->layout->getCell($x - 1, $y),
                $city->layout->getCell($x, $y),
                $city->layout->getCell($x + 1, $y),
            ],
            [
                $city->layout->getCell($x - 1, $y + 1),
                $city->layout->getCell($x, $y + 1),
                $city->layout->getCell($x + 1, $y + 1),
            ],
        ];
    }

    private function wallStatusForCell($cell)
    {
        return $cell !== null && $cell->insideWalls;
    }

    /**
     * @param int $x
     * @param int $y
     * @param int $quadrant  [[1, 2], [3, 4]]
     * @param City $city
     * @param array $consts
     * @return mixed
     * @throws \Exception
     */
    private function lineForCorner(int $x, int $y, int $quadrant, City $city, array $consts)
    {
        // neighbors are a 3X3 matrix of layout cells around the current cell (null means it's past the border)
        $cellNeighbors = $this->cellNeighbors($x, $y, $city);

        // quadrant tells what 2X2 group of the matrix is being analyzed to see what the corner connector should be
        switch ($quadrant) {
            case 1:
                $cellWallGroup = [
                    [$this->wallStatusForCell($cellNeighbors[0][0]), $this->wallStatusForCell($cellNeighbors[0][1])],
                    [$this->wallStatusForCell($cellNeighbors[1][0]), $this->wallStatusForCell($cellNeighbors[1][1])],
                ];
                break;
            case 2:
                $cellWallGroup = [
                    [$this->wallStatusForCell($cellNeighbors[0][1]), $this->wallStatusForCell($cellNeighbors[0][2])],
                    [$this->wallStatusForCell($cellNeighbors[1][1]), $this->wallStatusForCell($cellNeighbors[1][2])],
                ];
                break;
            case 3:
                $cellWallGroup = [
                    [$this->wallStatusForCell($cellNeighbors[1][1]), $this->wallStatusForCell($cellNeighbors[1][2])],
                    [$this->wallStatusForCell($cellNeighbors[2][1]), $this->wallStatusForCell($cellNeighbors[2][2])],
                ];
                break;
            case 4:
                $cellWallGroup = [
                    [$this->wallStatusForCell($cellNeighbors[1][0]), $this->wallStatusForCell($cellNeighbors[1][1])],
                    [$this->wallStatusForCell($cellNeighbors[2][0]), $this->wallStatusForCell($cellNeighbors[2][1])],
                ];
                break;
            default:
                throw new \Exception("Unknown quadrant: " . $quadrant);
        }

        $hasUp = $cellWallGroup[0][0] !== $cellWallGroup[0][1];
        $hasDown = $cellWallGroup[1][0] !== $cellWallGroup[1][1];
        $hasRight = $cellWallGroup[0][1] !== $cellWallGroup[1][1];
        $hasLeft = $cellWallGroup[0][0] !== $cellWallGroup[1][0];

        if ($hasUp && $hasDown && $hasLeft && $hasRight) {
            $piece = $consts[self::CROSS_WALL];
        } else if (!$hasUp && $hasDown && $hasLeft && $hasRight) {
            $piece = $consts[self::DOWN_WALL];
        } else if ($hasUp && $hasDown && !$hasLeft && $hasRight) {
            $piece = $consts[self::RIGHT_WALL];
        } else if ($hasUp && $hasDown && $hasLeft && !$hasRight) {
            $piece = $consts[self::LEFT_WALL];
        } else if ($hasUp && !$hasDown && $hasLeft && $hasRight) {
            $piece = $consts[self::UP_WALL];

        } else if ($hasUp && !$hasDown && $hasLeft && !$hasRight) {
            // '┘'
            $piece = $consts[self::BOTTOM_RIGHT_WALL];
        } else if (!$hasUp && $hasDown && $hasLeft && !$hasRight) {
            // '┐'
            $piece = $consts[self::TOP_RIGHT_WALL];
        } else if ($hasUp && !$hasDown && !$hasLeft && $hasRight) {
            // '└'
            $piece = $consts[self::BOTTOM_LEFT_WALL];
        } else if (!$hasUp && $hasDown && !$hasLeft && $hasRight) {
            // '┌'
            $piece = $consts[self::TOP_LEFT_WALL];

        } else if ($hasUp && $hasDown && !$hasLeft && !$hasRight) {
            $piece = $consts[self::VERTICAL_WALL];
        } else if (!$hasUp && !$hasDown && $hasLeft && $hasRight) {
            $piece = $consts[self::HORIZONTAL_WALL];
        } else if (!$hasUp && !$hasDown && !$hasLeft && !$hasRight) {
            $piece = $consts[self::BLANK_WALL];
        } else {
            throw new \Exception("Unknown wall status: $hasUp/$hasDown/$hasLeft/$hasRight");
        }

        return $piece;
    }}
