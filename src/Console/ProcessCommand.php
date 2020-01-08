<?php
namespace masud\Press\Console;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use masud\Press\PressFileParser;
use masud\Press\Post;
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
        if(is_null(config('press'))){
            return $this->warn("Please publish the config file by running 'php artisan vendor:publish --tag=press-config'");
        }
        //Fetch all posts
        $files = File::files(config('press.path'));

        //Process each file
        foreach ($files as $file) {
            $post = (new PressFileParser($file->getPathname()))->getData();

        }

        //Persist to the DB
        Post::create([
            'identifier' => Str::random(),
            'slug' => Str::slug($post['title']),
            'title' => $post['title'],
            'body' => $post['body'],
            'extra' => $post['body'] ?? []
        ]);
    }
}