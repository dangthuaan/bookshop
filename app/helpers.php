<?php
if (! function_exists('showCartQuantity')) {
    function showCartQuantity() {
        $currentUser = auth()->user();
        $newOrder = $currentUser->orders
            ->where('status', 1)
            ->first();

        if (isset($newOrder->books)) {
            return $newOrder->books->sum('pivot.quantity');
        }
        return 0;
    }
}