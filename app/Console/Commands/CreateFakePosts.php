<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Console\Command;

class CreateFakePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:fake-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creates 10 fake posts';

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
            $post = new Post();
            $post->user_id = User::query()->inRandomOrder()->first()->id;
            $post->title = $faker->text(30);
            $post->content = $faker->text(2000);
            $post->save();
        }
        return Command::SUCCESS;
    }
}
