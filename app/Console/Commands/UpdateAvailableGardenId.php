<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateAvailableGardenId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:availablegardenid';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update available_garden_id to user_id columns value in filled_cells table';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $userIds = DB::table('filled_cells')->select('user_id')->distinct()->get();
            foreach ($userIds as $id) {
                DB::table('filled_cells')
                    ->where(['user_id' => $id->user_id])
                    ->update(['available_garden_id' => $id->user_id]);
            }
        } catch (\Exception $e) {
            error_log("An error occurred");
        }
        return 0;
    }
}
