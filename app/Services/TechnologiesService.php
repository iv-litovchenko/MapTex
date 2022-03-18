<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\Technology;

class TechnologiesService
{
    /**
     * @param $name
     * @param $parent_id
     * @param $branch_stop_flag
     * @param $is_page_flag
     * @return void
     */
    public function create(
        string $name,
        int $parent_id = 0,
        int $branch_stop_flag = 0,
        int $is_page_flag = 0
    ) {
        try {
            DB::beginTransaction();
            $model = new Technology;
            $model->parent_id = $parent_id > 0 ? $parent_id : null;
            $model->name = $name;
            $model->branch_stop_flag = $branch_stop_flag;
            $model->is_page_flag = $is_page_flag;
            $model->is_draft_flag = 0;
            $model->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500);
        }
    }
}
