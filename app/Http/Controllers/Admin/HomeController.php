<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{
    public function index()
    {
        $settings1 = [
            'chart_title' => 'Total projects',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Project',
            'group_by_field' => 'created_at',
            'group_by_period' => 'year',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_period' => 'year',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class' => 'col-md-4',
            'entries_number' => '5',
            'translation_key' => 'project',
        ];

        $settings1['total_number'] = 0;
        if (class_exists($settings1['model'])) {
            $settings1['total_number'] = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                if (isset($settings1['filter_days'])) {
                    return $query->where($settings1['filter_field'], '>=',
                        now()->subDays($settings1['filter_days'])->format('Y-m-d'));
                } elseif (isset($settings1['filter_period'])) {
                    switch ($settings1['filter_period']) {
                        case 'week': $start = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month': $start = date('Y-m').'-01';
                            break;
                        case 'year': $start = date('Y').'-01-01';
                            break;
                    }
                    if (isset($start)) {
                        return $query->where($settings1['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings1['aggregate_function'] ?? 'count'}($settings1['aggregate_field'] ?? '*');
        }

        $settings2 = [
            'chart_title' => 'Total Teams',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\Team',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_period' => 'year',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class' => 'col-md-4',
            'entries_number' => '5',
            'translation_key' => 'team',
        ];

        $settings2['total_number'] = 0;
        if (class_exists($settings2['model'])) {
            $settings2['total_number'] = $settings2['model']::when(isset($settings2['filter_field']), function ($query) use ($settings2) {
                if (isset($settings2['filter_days'])) {
                    return $query->where($settings2['filter_field'], '>=',
                        now()->subDays($settings2['filter_days'])->format('Y-m-d'));
                } elseif (isset($settings2['filter_period'])) {
                    switch ($settings2['filter_period']) {
                        case 'week': $start = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month': $start = date('Y-m').'-01';
                            break;
                        case 'year': $start = date('Y').'-01-01';
                            break;
                    }
                    if (isset($start)) {
                        return $query->where($settings2['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings2['aggregate_function'] ?? 'count'}($settings2['aggregate_field'] ?? '*');
        }

        $settings3 = [
            'chart_title' => 'Total users',
            'chart_type' => 'number_block',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'email_verified_at',
            'group_by_period' => 'day',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_period' => 'year',
            'group_by_field_format' => 'Y-m-d H:i:s',
            'column_class' => 'col-md-4',
            'entries_number' => '5',
            'translation_key' => 'user',
        ];

        $settings3['total_number'] = 0;
        if (class_exists($settings3['model'])) {
            $settings3['total_number'] = $settings3['model']::when(isset($settings3['filter_field']), function ($query) use ($settings3) {
                if (isset($settings3['filter_days'])) {
                    return $query->where($settings3['filter_field'], '>=',
                        now()->subDays($settings3['filter_days'])->format('Y-m-d'));
                } elseif (isset($settings3['filter_period'])) {
                    switch ($settings3['filter_period']) {
                        case 'week': $start = date('Y-m-d', strtotime('last Monday'));
                            break;
                        case 'month': $start = date('Y-m').'-01';
                            break;
                        case 'year': $start = date('Y').'-01-01';
                            break;
                    }
                    if (isset($start)) {
                        return $query->where($settings3['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings3['aggregate_function'] ?? 'count'}($settings3['aggregate_field'] ?? '*');
        }

        $settings4 = [
            'chart_title' => 'Project Per Teams',
            'chart_type' => 'bar',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Models\Project',
            'group_by_field' => 'name',
            'aggregate_function' => 'count',
            'filter_field' => 'created_at',
            'filter_period' => 'year',
            'column_class' => 'col-md-12',
            'entries_number' => '5',
            'relationship_name' => 'team',
            'translation_key' => 'project',
        ];

        $chart4 = new LaravelChart($settings4);

        return view('home', compact('chart4', 'settings1', 'settings2', 'settings3'));
    }
}
