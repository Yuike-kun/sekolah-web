<?php

namespace App\Helpers;

use App\Models\Student;

class DashboardChart
{
    public static function DataStudent()
    {
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 9; $i--) {
            $dates = date('Y-m-d', strtotime('-'.$i.' day'));
            $datas = Student::whereYear('created_at', $dates)->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }

    public static function DataVerification()
    {
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 9; $i--) {
            $dates = date('Y-m-d', strtotime('-'.$i.' day'));
            $datas = Student::whereYear('created_at', $dates)
                ->where('verification_student', 'Terverifikasi')->get()->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }

    public static function DataNotVerification()
    {
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 9; $i--) {
            $dates = date('Y-m-d', strtotime('-'.$i.' day'));
            $datas = Student::whereYear('created_at', $dates)
                ->where('verification_student', 'Belum Diverifikasi')->get()->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }

    public static function DataGraduation()
    {
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 9; $i--) {
            $dates = date('Y-m-d', strtotime('-'.$i.' day'));
            $datas = Student::whereYear('created_at', $dates)
                ->where('verification_graduation', 'Lulus')->get()->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }

    public static function DataProcess()
    {
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 9; $i--) {
            $dates = date('Y-m-d', strtotime('-'.$i.' day'));
            $datas = Student::whereYear('created_at', $dates)
                ->where('verification_graduation', 'Proses')->get()->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }

    public static function DataNotGraduation()
    {
        $data = [
            'date' => [],
            'data' => [],
        ];

        for ($i = 9; $i >= 9; $i--) {
            $dates = date('Y-m-d', strtotime('-'.$i.' day'));
            $datas = Student::whereYear('created_at', $dates)
                ->where('verification_graduation', 'Tidak Lulus')->get()->count();

            $data['date'][] = date('d M Y', strtotime($dates));
            $data['data'][] = $datas ? $datas : 0;
        }

        return $data;
    }
}
