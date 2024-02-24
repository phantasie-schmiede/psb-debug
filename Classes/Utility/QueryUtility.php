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

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\Storage\Typo3DbQueryParser;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Fluid\View\StandaloneView;

/**
 * Class QueryUtility
 *
 * @package PSB\PsbDebug\Utility
 */
class QueryUtility
{
    /**
     * @param QueryInterface $query
     * @param string|null    $title
     *
     * @return void
     */
    public static function debug(QueryInterface $query, ?string $title = null): void
    {
        $queryParser = GeneralUtility::makeInstance(Typo3DbQueryParser::class);
        $sql = $queryParser->convertQueryToDoctrineQueryBuilder($query)->getSQL() . ';';
        $parameters = $queryParser->convertQueryToDoctrineQueryBuilder($query)->getParameters();
        $searchArray = array_keys($parameters);
        array_walk($searchArray, static function (&$value) {
            $value = ':' . $value;
        });
        $replaceArray = array_values($parameters);
        array_walk($replaceArray, static function (&$value) {
            if (is_string($value)) {
                $value = '"' . $value . '"';
            }
        });

        $template = GeneralUtility::makeInstance(StandaloneView::class);
        $template->setTemplatePathAndFilename(GeneralUtility::getFileAbsFileName('EXT:psb_debug/Resources/Private/Templates/Message.html'));
        $template->assignMultiple([
            // Revert search order so that "value10" gets replaced before "value1"!
            'message' => str_replace(array_reverse($searchArray), array_reverse($replaceArray), $sql),
            'title'   => $title ? : 'Query from ' . BackTraceUtility::getClass(2) . ':' . BackTraceUtility::getFunction(2),
        ]);

        echo $template->render();
    }
}
