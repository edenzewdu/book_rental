<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RentController extends Controller
{
    
    public function rent(Book $book)
    {
        // For now, just return a confirmation or redirect
        return redirect()->back()->with('success', 'You have successfully rented "' . $book->title . '"!');
    }
    public function return(Book $book)
    {
        // Logic to handle book return
        return redirect()->back()->with('success', 'You have successfully returned "' . $book->title . '"!');
    }
}
