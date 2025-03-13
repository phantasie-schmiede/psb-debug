<?php
declare(strict_types=1);

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

namespace PSB\PsbDebug\Helper;

/**
 * Class Backtrace
 *
 * @package PSB\PsbDebug\Helper
 */
class Backtrace
{
    public const DEFAULT_FORMAT = '{class}::{function} in {file}:{line}';

    protected array $backtrace;

    public function __construct()
    {
        $this->backtrace = debug_backtrace();
    }

    public function getBacktrace(): array
    {
        return $this->backtrace;
    }

    public function getCaller(int $level = 1): string
    {
        return $this->backtrace[$level]['class'] . '::' . $this->backtrace[1]['function'];
    }

    public function getCallerArgs(int $level = 1): array
    {
        return $this->backtrace[$level]['args'];
    }

    public function getCallerClass(int $level = 1): string
    {
        return $this->backtrace[$level]['class'];
    }

    public function getCallerFile(int $level = 1): string
    {
        return $this->backtrace[$level]['file'];
    }

    public function getCallerFunction(int $level = 1): string
    {
        return $this->backtrace[$level]['function'];
    }

    public function getCallerLine(int $level = 1): int
    {
        return $this->backtrace[$level]['line'];
    }

    public function getCallerObject(int $level = 1): object
    {
        return $this->backtrace[$level]['object'];
    }

    public function getCallerType(int $level = 1): string
    {
        return $this->backtrace[$level]['type'];
    }

    public function getFormattedOutput(string $format = self::DEFAULT_FORMAT, int $level = 1): string
    {
        return str_replace(
            [
                '{class}',
                '{function}',
                '{line}',
                '{file}',
            ],
            [
                $this->getCallerClass($level),
                $this->getCallerFunction($level),
                $this->getCallerLine($level),
                $this->getCallerFile($level),
            ],
            $format
        );
    }
}
