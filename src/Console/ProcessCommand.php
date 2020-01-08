<?php
namespace masud\Press\Console;
use Illuminate\Console\Command;
use masud\Press\Post;
use masud\Press\Facades\Press;
use masud\Press\Repositories\PostRepository;

use Illuminate\Support\Str;


class ProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'press:process';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update blog posts.';
    /**
     * Execute the console command.
     *
     * @param \masud\Press\Repositories\PostRepository $postRepository
     *
     * @return mixed
     */
    public function handle(PostRepository $postRepository)
    {   
        if(Press::configNotPublished()){
            return $this->warn("Please publish the config file by running 'php artisan vendor:publish --tag=press-config'");
        }

        try {
            $posts = Press::driver()->fetchPosts();

            $this->info('Number of Posts: '. count($posts));

            //Persist to the DB
            foreach ($posts as $post) {
                $postRepository->save($post);

                $this->info('Post title: '. $post['title']);
            }

        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

    }
}