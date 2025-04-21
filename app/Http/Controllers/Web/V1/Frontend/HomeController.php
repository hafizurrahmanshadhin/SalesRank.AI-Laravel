<?php

namespace App\Http\Controllers\Web\V1\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller {
    /**
     * Display the landing page.
     *
     * @return View
     */
    public function index(): View {
        return view('frontend.layouts.index.index');
    }
}
