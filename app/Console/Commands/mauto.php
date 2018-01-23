<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class mauto extends Command
{
    /**
     * 控制台命令 signature 的名称。
     *
     * @var string
     */
    protected $signature = 'ma:config{dbName}';

    /**
     * 控制台命令说明。
     *
     * @var string
     */
    protected $description = 'create table config';

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
        //
    }
}
