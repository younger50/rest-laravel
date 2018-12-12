<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// book model and resource
use App\Book;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookResource::collection(Book::with('ratings')->paginate(2));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // create book
        $book = Book::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        //
        return new BookResource($book);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
        return new BookResource($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        // check if currently authenticated user is the owner of the book
        if($request->user()->id !== $book->user_id){
            return response()->json(['error' => 'It\'s not your booking'], 403);
        }
        // update book
        $book->update($request->only(['title', 'description']));
        //
        return new BookResource($book);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Book $book)
    {
        // check user
        // delete book
        $book->delete();
        //
        return response()->json(null, 204);
    }
}
