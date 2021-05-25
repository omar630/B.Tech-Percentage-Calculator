<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class CreatePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        Permission::create(['name' => 'dashboard']);
        Permission::create(['name' => 'subjects']);
        Permission::create(['name' => 'subject-type']);
        Permission::create(['name' => 'upload-subject']);
        Permission::create(['name' => 'visitor']);
        Permission::create(['name' => 'registered-user']);
        Permission::create(['name' => 'regulation']);
        Permission::create(['name' => 'branch']);
        return 0;
    }
}
