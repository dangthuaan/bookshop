<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Order;
use App\Book;
use App\BookOrder;
use App\Http\Requests\BookOrderRequest;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('books')->get();
        return view('client.orders.order-manager', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $bookId = $request->book_id;
    //     $book = Book::findOrFail($bookId);

    //     $data = $request->only([
    //         'book_id'
    //     ]);

    //     $currentUserId = auth()->id();

    //     $totalPrice = $book->price;

    //     /* foreach ($book->orders as $bookOrder) {
    //         $totalPrice += $book->price * $bookOrder->pivot->quantity;
    //     } */

    //     $orderData = [
    //         'user_id' => $currentUserId,
    //         'total_price' => $totalPrice,
    //         'description' => 'xxx',
    //     ];

    //     $order = Order::where('user_id', $currentUserId)
    //         ->where('status', 1)
    //         ->first();

    //     try {
    //         if (is_null($order)) {
    //             foreach ($book->orders as $bookOrder) {
    //                 $orderData['total_price'] += $book->price;
    //             }

    //             $order = Order::create($orderData);
    //         }

    //         $ifExistBookOrder = BookOrder::where('order_id', $order->id)
    //         ->where('book_id', $book->id)
    //         ->first();

    //         /* $existBookOrder = $order->books()->wherePivot('book_id', $book->id)->first(); */

    //         if ($ifExistBookOrder) {

    //             $ifExistBookOrder->increment('quantity', 1);

    //             foreach ($book->orders as $bookOrder) {
    //                 $orderData['total_price'] += $book->price;
    //             }

    //             $order->update($orderData);

    //         } else {
    //             $book->orders()->attach($order->id, ['quantity' => 1, 'price' => $book->price]);

    //             foreach ($book->orders as $bookOrder) {
    //                 $orderData['total_price'] += $book->price;
    //             }

    //             $order->update($orderData);

    //         }
    //     } catch (\Exception $e) {
    //         \Log::error($e);
    //         $result = [
    //             'status' => false,
    //             'quantity' => 0,
    //         ];
    //         return response()->json($result);
    //     }
    //     $result = [
    //         'status' => true,
    //         'quantity' => $order->books->sum('pivot.quantity'),
    //     ];

    //     \Log::error($result);

    //     return response()->json($result);

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bookId = $request->book_id;
        $book = Book::findOrFail($bookId);

        $data = $request->only([
            'book_id'
        ]);

        $orders = Order::with('books')->get();

        $currentUserId = auth()->id();

        if ($orders->isEmpty()) $totalPrice = $book->price;
        else
        foreach ($orders as $order) {
            foreach ($order->books as $orderBook) {
                $totalPrice += $book->price * $orderBook->pivot->quantity;
            }
        }

        $orderData = [
            'user_id' => $currentUserId,
            'total_price' => $totalPrice,
            'description' => 'xxx',
        ];

        $order = Order::where('user_id', $currentUserId)
            ->where('status', 1)
            ->first();

        try {
            if (is_null($order)) {
                $order = Order::create($orderData);
            }

            $ifExistBookOrder = BookOrder::where('order_id', $order->id)
            ->where('book_id', $book->id)
            ->first();

            /* $existBookOrder = $order->books()->wherePivot('book_id', $book->id)->first(); */

            if ($ifExistBookOrder) {
                $ifExistBookOrder->increment('quantity', 1);
            } else {
                $book->orders()->attach($order->id, ['quantity' => 1, 'price' => $book->price]);
            }
        } catch (\Exception $e) {
            \Log::error($e);
            $result = [
                'status' => false,
                'quantity' => 0,
            ];
            return response()->json($result);
        }
        $result = [
            'status' => true,
            'quantity' => $order->books->sum('pivot.quantity'),
        ];

        \Log::error($result);

        return response()->json($result);

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

     /**
     * Increase the quantity of product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function plusQuantity(Request $request)
    {
        $bookId = $request->book_id;
        $book = Book::findOrFail($bookId);


        $data = $request->only([
            'book_id'
        ]);

        $currentUserId = auth()->id();

        $firstPrice = $book->price;

        $orderData = [
            'user_id' => $currentUserId,
            'total_price' => $firstPrice,
            'description' => 'xxx',
        ];

        $order = Order::where('user_id', $currentUserId)
            ->where('status', 1)
            ->first();

        try {
            $ifExistBookOrder = BookOrder::where('order_id', $order->id)
            ->where('book_id', $book->id)
            ->first();

            $ifExistBookOrder->increment('quantity', 1);

            $orderData['total_price'] = $book->price * $ifExistBookOrder->quantity;

            $order->update($orderData);

        } catch (\Exception $e) {
            \Log::error($e);
            $result = [
                'status' => false,
                'quantity' => 0,
            ];
            return response()->json($result);
        }

        $result = [
            'status' => true,
            'quantity' => $order->books->sum('pivot.quantity'),
        ];

        return response()->json($result);
    }

    /**
     * Decrease the quantity of product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function minusQuantity(Request $request)
    {

        $bookId = $request->book_id;
        $book = Book::findOrFail($bookId);


        $data = $request->only([
            'book_id',
        ]);

        $currentUserId = auth()->id();

        $firstPrice = $book->price;

        $orderData = [
            'user_id' => $currentUserId,
            'total_price' => $firstPrice,
            'description' => 'xxx',
        ];

        $order = Order::where('user_id', $currentUserId)
            ->where('status', 1)
            ->first();

        try {
            $ifExistBookOrder = BookOrder::where('order_id', $order->id)
            ->where('book_id', $book->id)
            ->first();

            $ifExistBookOrder->decrement('quantity', 1);
            if ($ifExistBookOrder->quantity == 0) $ifExistBookOrder->increment('quantity', 1);

            $orderData['total_price'] = $book->price * $ifExistBookOrder->quantity;

            $order->update($orderData);

        } catch (\Exception $e) {
            \Log::error($e);
            $result = [
                'status' => false,
                'quantity' => 0,
            ];
            return response()->json($result);
        }

        $result = [
            'status' => true,
            'quantity' => $order->books->sum('pivot.quantity'),
        ];

        return response()->json($result);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bookId = $request->book_id;
        $book = Book::findOrFail($bookId);

        $currentUserId = auth()->id();

        $order = Order::where('user_id', $currentUserId)
            ->where('status', 1)
            ->first();

        try {
            $order->delete();

            $book->orders()->detach($order->id);

        } catch (\Exception $e) {
            \Log::error($e);

            return response()->json($result);
        }

        return response()->json($result);
    }
}
