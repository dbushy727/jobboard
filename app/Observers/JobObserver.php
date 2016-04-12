<?php

namespace App\Observers;

class JobObserver
{
    public function creating($model)
    {
        $model->price = $model->is_featured ? env('BASE_PRICE') + env('FEATURE_PRICE') : env('BASE_PRICE');
        $model->session_id = \Session::getId();
    }
}
