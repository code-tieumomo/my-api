<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('id', '=', Auth::user()->id)->get();
        if (count($events) < 1) return null;

        return response()->json(compact('events'));
    }
}
