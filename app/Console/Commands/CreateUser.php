<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     *
     * @return int
     */
     public function handle()
    {
        $user = new User();
        $user->name = 'Amaranta';
        $user->phone = '8717095106';
        $user->password = Hash::make('Amaranta');
        $user->save();

        $this->info('User created successfully.');
    }
}
