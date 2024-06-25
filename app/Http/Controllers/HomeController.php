<?php

namespace App\Http\Controllers;

use App\Doctor;
use App\Service;
use App\InsuranceProvider;
use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use App\User;
use Stripe\Error\Card;
use App\Setting;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $doctors = Doctor::orderBy('id','desc')->get();
        $services = Service::orderBy('id','desc')->get();
        return view('front.home',compact('doctors','services'));
    }
    public function about(){
        return view('front.about');
    }
    public function services(){
        $services = Service::orderBy('id','desc')->get();
        return view('front.services',compact('services'));
    }
    public function pricing(){
        return view('front.pricing');
    }
    public function contact(){
        return view('front.contact');
    }
    public function blog(){
        return view('front.blog');
    }
    public function blog_detail(){
        return view('front.blog-detail');
    }
    public function appointment(){
        return view('front.appointment');
    }
    public function search_professionals(){
        return view('front.search-professionals');
    }
    public function team(){
        $doctors = Doctor::orderBy('id','desc')->get();
        return view('front.team',compact('doctors'));
    }
    public function testimonials(){
        return view('front.testimonials');
    }
    public function insurance_prviders(){
        $doctors = InsuranceProvider::orderBy('id','desc')->get();
        return view('front.insurance-prviders',compact('doctors'));
    }
    public function make_appointment(){
        $setting = Setting::first();
        return view('front.make-appointment',compact('setting'));
    }
}
