<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::paginate(5);
        return view( 'book.index', compact('books') );
    }

    public function create()
    {
        return view( 'book.create' );
    }

    public function store( BookStoreRequest $request )
    {
        $image = $request->file('image')->store('public/product');
        Book::create([
           'name'=> $request -> name,
           'description'=> $request -> description,
           'category'=> $request -> category,
            'image'=> $image
        ]);

        return back()->with( 'message', 'New Book Added' );
    }

    public function edit( $id )
    {
        $book = Book::find( $id );
        return view( 'book.edit', compact('book') );
    }

    public function update( BookUpdateRequest $request, $id)
    {
        $book = Book::find( $id );
        if( $request->hasFile('image') )
        {
            $image = $request->file('image')->store('public/product');
            $book->name = $request->name;
            $book->description = $request->description;
            $book->category = $request->category;
            $book->image = $image;
            $book->save();
        }
        else
        {
            $book->name = $request->name;
            $book->description = $request->description;
            $book->category = $request->category;
            $book->save();
        }

        return redirect()->route( 'book.index' )->with( 'message', 'Book Updated' );
    }

    public function destroy( $id )
    {
        $book = Book::find($id);
        $book->delete();
        return redirect()->route('book.index')->with('message', 'Book Deleted');
    }
}
