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

namespace PSB\PsbDebug\Utility;

/**
 * Class BackTraceUtility
 *
 * @deprecated since 1.0.0, will be removed in 2.0.0. Use new class \PSB\PsbDebug\Domain\Model\Backtrace instead.
 * @package    PSB\PsbDebug\Utility
 */
class BackTraceUtility
{
    /**
     * @param int $level
     *
     * @return string
     */
    public static function getClass(int $level = 1): string
    {
        return debug_backtrace()[$level]['class'];
    }

    /**
     * @param int $level
     *
     * @return string
     */
    public static function getFunction(int $level = 1): string
    {
        return debug_backtrace()[$level]['function'];
    }

    /**
     * @param int $level
     *
     * @return int
     */
    public static function getLine(int $level = 0): int
    {
        return debug_backtrace()[$level]['line'];
    }
}
