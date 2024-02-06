<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function index()
    {
        return view('example');
    }

    public function update(Request $request)
    {
        // Handle AJAX request and update data in the database

        return response()->json(['message' => 'Data updated successfully']);
    }
}