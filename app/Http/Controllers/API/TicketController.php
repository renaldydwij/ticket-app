<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Ticket::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'name_customer' => 'required',
            'email' => 'required|string|email|max:50',
            'comment' => 'required|max:100',/* 
            'foto' => 'required|mimes:jpg,jpeg,bmp,png|max:1024', */
        ]);
        
        /* $pathToFile = $request->file('foto')->store('images', 'public');
        return $pathToFile; */

        return Ticket::create([
            'name' => $request->name,
            'name_customer' => $request->name_customer,
            'email' => $request->email,
            'comment' => $request->comment/* 
            'photo' => $request->photo */
        ]); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ticket = Ticket::findOrFail($id);
        // delete the ticket

        $ticket->delete();

        return ['message' => 'Ticket Deleted'];
    }
}
