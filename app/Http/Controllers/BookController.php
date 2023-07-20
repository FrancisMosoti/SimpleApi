<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Books;

class BookController extends Controller
{
    //

    public function index()
    {
        $books = Books::all();
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $book =  new Books;
        $book->name =  $request->name;
        $book->author =  $request->author;
        $book->publish_date =  $request->publish_date;
        $book->save();
        return response()->json([
            "status" => "success",
            "message" => "Book Added"
        ], 201);
    }

    public function show($id)
    {
        $book = Books::find($id);
        if(!empty($book)){
            return response()->json($book);
        }
        else
        {
            return response()->json([
                "status" => "error",
                "message" => "Book Not Found"
            ], 404);
        }
    }

    public function update(Request $request, $id){
        $book = Books::find($id);
        if(!empty($book)){
            $book->name =  $request->name;
            $book->author =  $request->author;
            $book->publish_date =  $request->publish_date;
            $book->save();
            return response()->json([
                "status" => "success",
                "message" => "Book Updated"
            ], 201);
        }
        else
        {
            return response()->json([
                "status" => "error",
                "message" => "Book Not Found"
            ], 404);
        }
    }

    public function destroy($id){
        if(Books::where('id', $id)->exists()){
            $book = Books::find($id);
            $book->delete();
            return response()->json([
                "status" => "success",
                "message" => "Book Deleted"
            ], 201);
        }else {
            return response()->json([
                "status" => "error",
                "message" => "Book Not Found"
            ], 404);
        }
    }
}
