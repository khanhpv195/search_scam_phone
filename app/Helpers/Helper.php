<?php

namespace App\Helpers;

class Helper
{
    /**
     * Get the HTML badge for a given phone status.
     *
     * @param  string  $status
     * @return string
     */
    public static function statusBadge($status)
    {
        switch ($status) {
            case 'spam':
                return '<span class="badge bg-danger">Làm phiền</span>';
            case 'scam':
                return '<span class="badge bg-warning text-dark">Lừa đảo</span>';
            case 'positive':
                return '<span class="badge bg-success">Tích cực</span>';
            case 'uncertain':
                return '<span class="badge bg-info">Chưa có thông tin </span>';
            default:
                return '<span class="badge bg-secondary">Chưa có thông tin</span>';
        }
    }
}
