<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
class LanguageController extends Controller
{
    public function setLanguage(Request $request) : RedirectResponse
    {
        session()->put('language', $request->input('language'));
        return back()->withInput();
    }
}
