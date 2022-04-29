<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessagesCollection;
use App\Models\Message;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return response()->json(
            new MessagesCollection(Message::with(['source'])->simplePaginate())
        );
    }
}
