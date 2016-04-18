<?php

use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createOriginal();
        $this->createReplacement();
    }

    protected function createOriginal()
    {
        $job = factory(App\Models\Job::class)->create();

        $job->is_paid   = true;

        $job->save();
    }
    protected function createReplacement()
    {
        $original = app('App\Models\Job')->first();
        $replacement = factory(App\Models\Job::class)->create();

        $replacement->replacement_id = $original->id;

        $replacement->save();
    }
}
