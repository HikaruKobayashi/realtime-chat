<?php

namespace App\Http\Controllers\Ajax;

use App\Events\MessageCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatController extends Controller
{
  public function index() {
    return \App\Models\Message::orderBy('id', 'desc')->get();
  }
  public function create(Request $request) {
    $message = \App\Models\Message::create([
      'body' => $request->message
    ]);
    event(new MessageCreated($message));
  }
}
