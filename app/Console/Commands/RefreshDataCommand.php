<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RefreshDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'finance:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh the finance DB';

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
        $this->call('down', ['--render' => "errors::refresh"]);

        DB::table('transactions')->truncate();
        DB::table('sms')->truncate();
        DB::table('brands')->truncate();
        DB::table('categories')->truncate();
        $this->call('db:seed', ['--force' => true]);

        $this->call('up');

        return 0;
    }
}
