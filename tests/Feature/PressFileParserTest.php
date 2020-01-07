<?php
namespace masud\Press\Tests;

use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;
use masud\Press\PressFileParser;

class PressFileParserTest extends TestCase{

	/** @test */
    public function the_head_and_body_gets_split()
    {	
        $filePath = realpath(__DIR__.'./../blogs/MarkFile1.md');
        
        $pressFileParser = (new PressFileParser($filePath));

        $data = $pressFileParser->getData();
        
        $this->assertStringContainsString('title: My Title', $data[1]);
        $this->assertStringContainsString('description: Description here', $data[1]);
        $this->assertStringContainsString('Blog post body here', $data[2]);
    }

    /** @test */
    public function a_string_can_also_be_used_instead()
    {
        $pressFileParser = (new PressFileParser("---\ntitle: My Title\n---\nBlog post body here"));
        $data = $pressFileParser->getData();
        $this->assertStringContainsString('title: My Title', $data[1]);
        $this->assertStringContainsString('Blog post body here', $data[2]);
    }


    /** @test */
    public function each_head_field_gets_separated()
    {   
        $filePath = realpath(__DIR__.'./../blogs/MarkFile1.md');
        $pressFileParser = (new PressFileParser($filePath));

        $data = $pressFileParser->getData();

        // dd($data);
        
        $this->assertEquals('My Title', $data['title']);
        $this->assertEquals('Description here', $data['description']);
    }

    /** @test */
    public function the_body_gets_saved_and_trimmed()
    {   
        $filePath = realpath(__DIR__.'./../blogs/MarkFile1.md');
        $pressFileParser = (new PressFileParser($filePath));

        $data = $pressFileParser->getData();

        // dd($data);
        
         $this->assertEquals("<h1>Heading</h1>\n<p>Blog post body here</p>", $data['body']);
    }

    /** @test */
    public function a_date_field_gets_parsed()
    {
        $pressFileParser = (new PressFileParser("---\ndate: January 7, 2020\n---\n"));
        $data = $pressFileParser->getData();
        
        $this->assertInstanceOf(Carbon::class, $data['date']);
        $this->assertEquals('01/07/2020', $data['date']->format('m/d/Y'));
    }
}
