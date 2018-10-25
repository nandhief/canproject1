<?php

if (! function_exists('json')) {
    function json($data = [], $pesan = 'success',  $kode = 1)
    {
        return response()->json(['kode' => $kode, 'pesan' => $pesan, 'result' => $data]);
    }
}
