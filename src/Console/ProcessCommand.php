<?php
namespace masud\Press\Console;
use Illuminate\Console\Command;
use masud\Press\Post;
use masud\Press\Facades\Press;
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
     * @param \vicgonvt\Press\Repositories\PostRepository $postRepository
     *
     * @return mixed
     */
    public function handle()
    {   
        if(Press::configNotPublished()){
            return $this->warn("Please publish the config file by running 'php artisan vendor:publish --tag=press-config'");
        }

        try {
            $posts = Press::driver()->fetchPosts();


            //Persist to the DB
            foreach ($posts as $post) {
                Post::create([
                    'identifier' => $post['identifier'],
                    'slug' => Str::slug($post['title']),
                    'title' => $post['title'],
                    'body' => $post['body'],
                    'extra' => $post['body'] ?? []
                ]);
            }

        } catch (\Exception $e) {
            $this->error($e->getMessage());
        }

    }
}