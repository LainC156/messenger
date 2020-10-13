<?php

namespace App\Http\Controllers;

use App\Message;
use DB;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user_id = auth()->id();
        $contact_id = $request->contact_id;
        return Message::select(
            'id',
            'from_id',
            'to_id',
            'content',
            'created_at',
            DB::raw("IF(`from_id`=$user_id,true,false) as written_by_me")
            )->where(function($query) use($user_id, $contact_id) {
                $query->where('from_id',$user_id)->where('to_id', $contact_id);
            })->orWhere(function($query) use($user_id, $contact_id) {
                $query->where('from_id', $contact_id)->where('to_id', $user_id);
            })->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $message = new Message();
         $message->from_id = auth()->id();
         $message->to_id = $request->to_id;
         $message->content = $request->content;
         $message->save();

         $data = [];
         $data['success'] = $message;
         return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
