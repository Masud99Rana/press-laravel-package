<?php
namespace masud\Press\Http\Controllers;

use Illuminate\Routing\Controller;

class TestController extends Controller
{
    public function index()
    {
        return __method__ ." is working!!";
    }
}