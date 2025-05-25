<?php

return [
    'disable' => env('CAPTCHA_DISABLE', false),
    'characters' => ['2', '3', '4', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'j', 'm', 'n', 'p', 'q', 'r', 't', 'u', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'M', 'N', 'P', 'Q', 'R', 'T', 'U', 'X', 'Y', 'Z'],
    
    'default' => [
        'length' => 4,
        'width' => 240,        // Lebar diperbesar untuk centering yang lebih baik
        'height' => 100,       // Tinggi diperbesar untuk ruang yang cukup
        'quality' => 95,       // Kualitas ditingkatkan
        'math' => false,
        'expire' => 60,
        'encrypt' => false,
        'bgColor' => '#FFFFFF',
        'fontColors' => ['#2c3e50', '#34495e'], // Warna yang lebih kontras dan profesional
        'angle' => 8,          // Sudut kemiringan dikurangi untuk kejelasan
        'sharpen' => 15,       // Pertajaman ditingkatkan
        'contrast' => 8,       // Kontras diperkuat
        'invert' => false,
        'blur' => 0,           // Hilangkan blur untuk kejelasan maksimal
        'font' => base_path('public/fonts/arial.ttf'),
        'fontSize' => 24,      // Ukuran font yang lebih besar
        'lines' => 2,          // Garis gangguan minimal
        'sensitive' => false,  // Non-case sensitive untuk kemudahan
    ],

    'math' => [
        'length' => 9,
        'width' => 160,
        'height' => 50,        // Tinggi diperbesar
        'quality' => 95,
        'math' => true,
        'bgColor' => '#f8f9fa',
        'fontColors' => ['#2c3e50'],
        'fontSize' => 18,
        'angle' => 5,
        'sharpen' => 12,
        'contrast' => 6,
    ],

    'flat' => [
        'length' => 5,         // Panjang dikurangi untuk kejelasan
        'width' => 200,        // Lebar diperbesar
        'height' => 60,        // Tinggi optimal
        'quality' => 95,
        'lines' => 3,          // Garis gangguan dikurangi
        'bgImage' => false,    // Hilangkan background image untuk kejelasan
        'bgColor' => '#f1f2f6',
        'fontColors' => ['#2c3e50', '#e74c3c', '#3498db', '#2ecc71'], // Warna yang lebih kontras
        'contrast' => 10,      // Kontras ditingkatkan
        'fontSize' => 20,
        'angle' => 6,
        'sharpen' => 12,
    ],

    'mini' => [
        'length' => 3,
        'width' => 80,         // Lebar diperbesar proporsional
        'height' => 40,        // Tinggi diperbesar
        'quality' => 95,
        'bgColor' => '#ffffff',
        'fontColors' => ['#2c3e50'],
        'fontSize' => 16,
        'angle' => 5,
        'sharpen' => 10,
        'contrast' => 8,
        'lines' => 1,
    ],

    'inverse' => [
        'length' => 5,
        'width' => 160,
        'height' => 25,        // Tinggi diperbesar
        'quality' => 95,
        'sensitive' => false,  // Non-case sensitive
        'angle' => 8,          // Sudut dikurangi
        'sharpen' => 12,
        'blur' => 0,           // Hilangkan blur
        'invert' => true,
        'contrast' => 15,      // Kontras ditingkatkan untuk mode invert
        'fontSize' => 18,
        'lines' => 2,
    ],

    // Konfigurasi tambahan untuk CAPTCHA yang sangat jelas
    'clear' => [
        'length' => 4,
        'width' => 200,
        'height' => 80,
        'quality' => 100,
        'math' => false,
        'expire' => 60,
        'encrypt' => false,
        'bgColor' => '#ffffff',
        'fontColors' => ['#000000'], // Hitam murni untuk kontras maksimal
        'angle' => 0,          // Tanpa kemiringan
        'sharpen' => 20,       // Pertajaman maksimal
        'contrast' => 20,      // Kontras maksimal
        'invert' => false,
        'blur' => 0,
        'lines' => 0,          // Tanpa garis gangguan
        'fontSize' => 24,      // Font besar
        'font' => base_path('public/fonts/arial.ttf'),
        'sensitive' => false,
    ]
];