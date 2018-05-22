<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ManageNominations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'nominations:manage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start and end nominations by time';

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
     * @return mixed
     */
    public function handle()
    {
        DB::table('nominations')
            ->where('from_time', '>', now())
            ->where('to_time', '>', now())
            ->where('status', '<>', 'inactive')
            ->update(['status' => 'inactive']);

        DB::table('nominations')
            ->where('from_time', '<', now())
            ->where('to_time', '>', now())
            ->where('status', '<>', 'active')
            ->update(['status' => 'active']);

        DB::table('nominations')
            ->where('from_time', '<', now())
            ->where('to_time', '<', now())
            ->where('status', '<>', 'inactive')
            ->update(['status' => 'inactive']);
    }
}
