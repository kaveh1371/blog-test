<?php

namespace App\Console\Commands;

use App\Models\User;
use Faker\Factory;
use Illuminate\Console\Command;

class CreateFakeUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:fake-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creates 10 fake users';

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
        $faker = Factory::create();
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->name = $faker->name();
            $user->email = $faker->email();
            $user->password = $faker->password;
            $user->save();
        }
        return Command::SUCCESS;
    }
}
