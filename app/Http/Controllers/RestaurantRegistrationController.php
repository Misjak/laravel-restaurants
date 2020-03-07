<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Restaurant;
use App\Comment;

class RestaurantRegistrationController extends Controller
{
    public function form() 
    {
        return view('auth.restaurant-register');
    }

    public function register(Request $request) 
    {
        // validate

        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        Restaurant::create([
            'user_id' => $user->id,
            'name' => $request->input('restaurant_name'),
            'city' => $request->input('restaurant_city'),
            'description' => $request->input('restaurant_description'),

        ]);

        Auth::attempt([
            'email' => $user -> email, 
            'password' => $request->input('password')
            ]);

        return redirect('/home');
    }

    public function index() 
    {
        $restaurants = Restaurant::all();
        return view('restaurants.index', compact('restaurants'));
    }

    public function show($id) 
    {
        $restaurant = Restaurant::findOrFail($id);
        $user = $restaurant->user;


        return view('restaurants.show', compact('restaurant', 'user'));
    }

    public function store(Request $request, $restaurant_id) 
    {
        $this->validate($request, [
            'comment' => 'required'
        ]); 
    
        $restaurant = Restaurant::findOrFail($restaurant_id);
        $comment = new Comment;
    
        $comment ->restaurant_id = $restaurant_id;
        $comment ->user_id=auth()->id();
        $comment ->comment = $request->input('comment');
    
        $comment ->save();

        session()->flash('success_message', 'Comment saved.');
        
        return redirect()->back();
    }

    public function delete(Request $request, $id) {
        $comment= Comment::findOrFail($id);

        $comment->delete();

        return redirect()->back();
    }
}
