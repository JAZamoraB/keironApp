<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;

class TicketsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(["Tuser", "Tname"]);
        if(Ticket::where("name", $request->input("Tname"))->first()){
            return redirect()->back();
        }
        Ticket::create(["user_id" => $request->input("Tuser"), "name" => $request->input("Tname")]);
        return redirect()->back();
        // dd($NU);
    }
}
