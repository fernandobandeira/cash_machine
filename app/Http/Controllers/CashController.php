<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CashController extends Controller
{
    public function withdraw(Request $request) {
        $notes = [100,50,20,10];
        $c = 0;
        $result = [];
        $amount = (int) $request->amount;
        
        if (!is_int($amount) || $amount < 0) {
            throw new \InvalidArgumentException('Only positive integers are accepted.');
        }

        // Ө(n) where n is the number of available notes.
        while ($amount > 0 && $c != count($notes)) {
            $r = $amount / $notes[$c];
            $n = array_fill(0, $r, $notes[$c]);
            $result = array_merge($result, $n);
            $amount = $amount % $notes[$c];
            $c++;
        }

        if ($amount != 0) {
            throw new \App\Exceptions\NoteUnavailableException("There's no available notes for the requested amount.");
        }

        return $result;
    }
}
