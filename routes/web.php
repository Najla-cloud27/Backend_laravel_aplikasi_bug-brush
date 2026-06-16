<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing_page');
});

Route::get('/download-apk', function () {
    $path = public_path('apk/fokusin.apk');

    if (file_exists($path)) {
        return response()->download($path, 'fokusin.apk', [
            'Content-Type' => 'application/vnd.android.package-archive',
        ]);
    }

    return redirect('https://fokusin.najlahaura.my.id/apk/fokusin.apk');
});