<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $books = Book::all();

        return response()->json([
            'status' => 'success',
            'books' => $books,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
        ]);

        $book = Book::create([
            'title' => $request->title,
            'author' => $request->author,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Book created successfully',
            'book' => $book,
        ]);
    }

    public function show($id)
    {
        $book = Book::find($id);

        return response()->json([
            'status' => 'success',
            'book' => $book,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
        ]);

        $book = Book::find($id);

        $book->title = $request->title;
        $book->author = $request->author;

        $book->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Book updated successfully',
            'book' => $book,
        ]);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        $book->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Book deleted successfully',
        ]);
    }
}
