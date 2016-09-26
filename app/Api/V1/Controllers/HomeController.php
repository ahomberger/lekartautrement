<?php namespace App\Http\Controllers;

use File;

class HomeController extends Controller {

    public function index()
    {
        return File::get(public_path().'/index.html');
    }

    public function admin()
    {
        return File::get(public_path().'/admin.html');
    }

}