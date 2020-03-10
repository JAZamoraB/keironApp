<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function destroy(Request $request, $id)
    {
        Ticket::find($id)->delete();
        return redirect()->back();
    }
    public function asyncRedeem($id)
    {
        $t = Ticket::find($id);
        if(Auth::user()->id != $t->user_id){
            return "403";
        }
        $t->used = true;
        $t->save();
        return $t;
        return redirect()->back();
    }

    public function asyncCreate(Request $request){
        // return $request->all();
        if(Ticket::where("name", $request->name)->first()){
            return false;
        }
        $new = Ticket::create(["user_id" => $request->input("user"), "name" => $request->input("name")]);
        return $new;
    }
    public function asyncEdit(Request $request){
        // return $request->all();
        if(!Ticket::find($request->id) || Ticket::where(["name" => $request->name, ["id", "<>", $request->id]])->first()){
            return false;
        }
        Ticket::find($request->id)->update(["user_id" => $request->input("user"), "name" => $request->input("name")]);
        return Ticket::with("user")->   find($request->id);
    }
    public function ticketValidation(Request $request){
        if(Ticket::where("name", $request->name)->first()){
            return false;
        }
        return true;
    }
}
