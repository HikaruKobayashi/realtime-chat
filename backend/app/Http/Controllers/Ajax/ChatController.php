<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
  public function index() {
    return \App\Models\Message::orderBy('id', 'desc')->get();
  }
  public function create(Request $request) {
    $message = \App\Models\Message::create([
      'body' => $request->message
    ]);
    // Error↓
    event(new MessageCreated($message));
  }
}
