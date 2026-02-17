<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class XorController extends Controller
{
    public function index()
    {
        return view("index");
    }

    // ✅ ENCRYPTION
    public function encrypt(Request $request)
    {
        $plaintext = $request->plaintext;
        $key = $request->key;

        if (strlen($plaintext) !== strlen($key)) {
            return back()->with("error", "Plaintext and key must be same length!");
        }

        $ciphertext = "";

        for ($i = 0; $i < strlen($plaintext); $i++) {

            $pChar = ord($plaintext[$i]);
            $kChar = ord($key[$i]);

            $xor = $pChar ^ $kChar;

            $ciphertext .= str_pad(decbin($xor), 8, "0", STR_PAD_LEFT) . " ";
        }

        return back()->with([
            "ciphertext" => trim($ciphertext),
            "plaintext" => $plaintext,
        ]);
    }

    // ✅ DECRYPTION
    public function decrypt(Request $request)
    {
        $ciphertext = $request->ciphertext;
        $key = $request->key2;

        // Convert binary string into array
        $cipherArray = explode(" ", trim($ciphertext));

        if (count($cipherArray) !== strlen($key)) {
            return back()->with("error", "Ciphertext and key must be same length!");
        }

        $decryptedText = "";

        for ($i = 0; $i < count($cipherArray); $i++) {

            $cBin = bindec($cipherArray[$i]); // binary → decimal
            $kChar = ord($key[$i]);

            $xor = $cBin ^ $kChar;

            $decryptedText .= chr($xor);
        }

        return back()->with([
            "decrypted" => $decryptedText
        ]);
    }
}
