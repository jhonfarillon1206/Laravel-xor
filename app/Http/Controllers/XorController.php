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
        $plaintext_bits = "";
        $key_bits = "";

        for ($i = 0; $i < strlen($plaintext); $i++) {
            $pChar = ord($plaintext[$i]);
            $kChar = ord($key[$i]);
            $xor = $pChar ^ $kChar;

            $pBin = str_pad(decbin($pChar), 8, "0", STR_PAD_LEFT);
            $kBin = str_pad(decbin($kChar), 8, "0", STR_PAD_LEFT);
            $xorBin = str_pad(decbin($xor), 8, "0", STR_PAD_LEFT);

            $plaintext_bits .= $pBin;
            $key_bits .= implode(' ', str_split($kBin)) . ' ';
            $ciphertext .= $xorBin;
        }

        return back()->with([
            "plaintext" => $plaintext,
            "key" => $key,
            "plaintext_bits" => $plaintext_bits,
            "key_bits" => trim($key_bits),
            "ciphertext_bits" => $ciphertext
        ]);
    }


    // ✅ DECRYPTION
    // public function decrypt(Request $request)
    // {
    //     $ciphertext = $request->ciphertext; 
    //     $key = $request->key2;

    //     if (strlen($ciphertext) !== strlen($key) * 8) {
    //         return back()->with("error", "Ciphertext length and key length do not match!");
    //     }

    //     $decryptedText = "";
    //     $plaintext_bits = "";
    //     $key_bits = "";
    //     $cipher_bits = "";

    //     for ($i = 0; $i < strlen($key); $i++) {
    //         $keyChar = $key[$i];
    //         $kChar = ord($keyChar);
    //         $pBin = substr($ciphertext, $i * 8, 8); 
    //         $cDec = bindec($pBin);
    //         $pChar = chr($cDec ^ $kChar);

    //         $decryptedText .= $pChar;

    //         // store for compact table
    //         $plaintext_bits .= str_pad(decbin($cDec ^ $kChar), 8, "0", STR_PAD_LEFT);
    //         $key_bits .= implode(' ', str_split(str_pad(decbin($kChar), 8, '0', STR_PAD_LEFT))) . ' ';
    //         $cipher_bits .= $pBin;
    //     }

    //     return back()->with([
    //         "decrypted" => $decryptedText,
    //         "key" => $key,
    //         "plaintext_bits" => $plaintext_bits,
    //         "key_bits" => trim($key_bits),
    //         "ciphertext_bits" => $cipher_bits
    //     ]);
    // }
}
