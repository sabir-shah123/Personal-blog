<?php

namespace App\Http\Controllers;

use App\Post;
use App\Service;
use App\Slider;
use App\Testimonial;
use Illuminate\Http\Request;

class FrontpageController extends Controller
{

    public function index()
    {
        $sliders = Slider::latest()->get();
        $services = Service::orderBy('service_order')->get();
        $testimonials = Testimonial::latest()->get();
        $posts = Post::latest()->where('status', 1)->take(6)->get();
        return view('frontend.index', compact('sliders', 'services', 'testimonials', 'posts'));
    }


}
