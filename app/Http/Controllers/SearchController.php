<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class SearchController extends Controller
{
// Search for a user by using matric id
  public function search(Request $request)
  {
    $query = $request->get("query");
    $users = User::where( "matric_id" , "like" , "%" . $query .  "%" ) -> get();
  return view('user.viewUser',['users'=> $users]);
  }
}