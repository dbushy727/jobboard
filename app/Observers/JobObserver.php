<?php

namespace App\Observers;

class JobObserver
{
    public function creating($model)
    {
        $this->setPrice($model);
        $this->setEditToken($model);
        $this->setSessionToken($model);
    }

    public function created($model)
    {
        $model->addSlug();
    }

    protected function setPrice($model)
    {
        $model->price = $model->is_featured ? env('BASE_PRICE') + env('FEATURE_PRICE') : env('BASE_PRICE');
    }

    protected function setEditToken($model)
    {
        $model->edit_token = str_random(40);
    }

    protected function setSessionToken($model)
    {
        $model->session_token = \Session::getId();
    }
}
