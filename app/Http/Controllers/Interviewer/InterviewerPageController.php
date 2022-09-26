<?php

namespace App\Http\Controllers\Interviewer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class InterviewerPageController extends Controller
{
    public function index(){
        return view('interviewer.index');
    }
}
