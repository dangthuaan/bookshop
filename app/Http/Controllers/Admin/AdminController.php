<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\BookRequest;
use App\Book;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Redirect;
use App\Http\Controllers\Controller;
use App\Traits\UploadTrait;

class AdminController extends Controller
{
    use UploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* \DB::connection()->enableQueryLog();
        $books = Book::with('categories')->get();
        $queries = \DB::getQueryLog();
        dd($queries); */

        $books = Book::with('categories')->get();

        return view('admin.books.book-manager', compact('books'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$bookCategories = Book::with('categories')->get();

        $categories = Category::all();


        return view('admin.books.create-book', compact('categories'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $data = $request->only([
            'image',
            'title',
            'author',
            'publisher',
            'publish_date',
            'language',
            'price',
        ]);

        $data['user_id'] = Auth::id();

		if ($request->has('image')) {
			$image = $data['image'];
			// Make a image name based on user name and current timestamp
			$name = $data['title'] . '_' . time();
			// Define folder path
			$folder = 'img/';
			// Make a file path where image will be stored [ folder path + file name + file extension]
			$filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
			// Upload image
			$this->uploadOne($image, $folder, 'public', $name);
			// Set user profile image path in database to filePath
			$data['image'] = $filePath;
        }

        $category_id = $request->only(['category_id']);

        try {
            $book = Book::create($data);
            $book->categories()->attach($category_id);
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('createFailed', 'Create failed!');
        }
        return redirect('/admin/books')->with('status', 'Create success!');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        $data = ['book' => $book];
        return view('admin.books.book-manager', $data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $data = ['book' => $book];
        return view('admin.books.edit-book', $data);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, $id)
    {
        $data = $request->only([
            'image',
            'title',
            'author',
            'publisher',
            'publish_date',
            'language',
            'price',
        ]);

        $book = Book::findOrFail($id);

        if ($request->hasFile('image')) {
			$image = $data['image'];
			// Make a image name based on user name and current timestamp
			$name = $data['title'] . '_' . time();
			// Define folder path
			$folder = 'img/';
			// Make a file path where image will be stored [ folder path + file name + file extension]
			$filePath = $folder . $name . '.' . $image->getClientOriginalExtension();
			// Upload image
			$this->uploadOne($image, $folder, 'public', $name);
			// Set user profile image path in database to filePath
			$data['image'] = $filePath;
        }

        try {
            $book->update($data);
        } catch (Exception $e) {
            Log::error($e);
            return back()->with('updateFailed', 'Update failed!');
        }
        return redirect('admin/books')->with('status', 'Update success!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        try {
            $book->delete();
        } catch (\Exception $e) {
            \Log::error($e);
            return back()->with('status', 'Delete failed.');
        }
        return redirect('admin/books')->with('status', 'Delete success');
    }
}