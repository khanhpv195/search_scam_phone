<?php

namespace App\Helpers;

class Helper
{
    /**
     * Get the HTML badge for a given phone status.
     *
     * @param string $status
     * @return string
     */
    public static function statusBadge($status)
    {
        switch ($status) {
            case 'spam':
                return '<span class="badge bg-danger">Số rác</span>';
            case 'scam':
                return '<span class="badge bg-warning text-dark">Lừa đảo</span>';
            case 'positive':
                return '<span class="badge bg-success">Tin cậy</span>';
            case 'uncertain':
                return '<span class="badge bg-info">Chưa có thông tin </span>';
            default:
                return '<span class="badge bg-secondary">Chưa có thông tin</span>';
        }
    }


    function isBeautifulPhoneNumber($phoneNumber) {
        // Normalize the phone number by removing any non-numeric characters
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // Check for "beautiful" patterns
        $patterns = [
            '/(\d)\1{3}/',  // Tứ quý
            '/(\d)\1{2}/',  // Tam
            '/(\d)\1/',     // Lặp
            '/6/',          // Có số 6
            '/8/',          // Có số 8
            '/9/',          // Có số 9
            '/68/',         // Lộc phát
            '/8989/',       // Phát mãi
            '/8888/'        // Tứ quý 8888
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $phoneNumber)) {
                return true;
            }
        }

        return false;
    }


    function determinePhoneType($phoneNumber) {
        // Chuẩn hóa số điện thoại bằng cách loại bỏ các ký tự không phải số
        $phoneNumber = preg_replace('/\D/', '', $phoneNumber);

        // Danh sách đầu số máy bàn
        $landlinePrefixes = [
            '0282', '0283', '0286', '0287', '0289',
            '0242', '0243', '0246', '0247', '0248', '0249'
        ];

        // Xác định đầu số của số điện thoại
        $prefix = substr($phoneNumber, 0, 4);

        // Kiểm tra xem đầu số có nằm trong danh sách máy bàn không
        if (in_array($prefix, $landlinePrefixes)) {
            return "desk_number";
        } else {
            return "mobile_number";
        }
    }




}
