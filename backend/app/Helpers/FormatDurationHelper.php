<?php

use Carbon\CarbonInterval;

function formatDuration($seconds)
{
    $interval = CarbonInterval::seconds($seconds)->cascade();

    $parts = [];

    if ($interval->days > 0) {
        $parts[] = $interval->days . ' hari';
    }

    if ($interval->hours > 0 || $interval->days > 0) {
        $parts[] = $interval->hours . ' jam';
    }

    if ($interval->minutes > 0 || $interval->hours > 0 || $interval->days > 0) {
        $parts[] = $interval->minutes . ' menit';
    }

    $parts[] = round($interval->seconds, 2) . ' detik';

    return implode(' ', $parts);
}