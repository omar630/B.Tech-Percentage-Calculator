<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\user_data;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Stevebauman\Location\Facades\Location;

class locationfromip extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:find';

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
        $users = user_data::all();
        $bar = $this->output->createProgressBar(count($users));
        $bar->start();
        $admin = User::where('email', 'omarmd2311@gmail.com')->first();
        $role = Role::create(['name' => 'admin']);
        Role::create(['name' => 'super-admin']);
        $admin->assignRole('super-admin');
        foreach ($users as $user) {
            if (is_null($user->location) && $position = Location::get($user->ip_address)) {
                $user->location = $position;
                $user->save();
            }
            $bar->advance();
        }
        $bar->finish();
        return 0;
    }
}
