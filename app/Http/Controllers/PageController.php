<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PageController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function form()
    {
        return view('form');
    }

    public function submit(Request $request)
    {
$validated = $request->validate([
    'name'    => 'required|string|min:2|max:50',
    'email'   => 'required|email',
    'message' => 'required|string|min:5|max:500',
], [
    'name.required'    => 'Поле "Имя" обязательно для заполнения.',
    'name.min'         => 'Имя должно содержать минимум 2 символа.',
    'name.max'         => 'Имя не должно превышать 50 символов.',
    'email.required'   => 'Поле "Email" обязательно для заполнения.',
    'email.email'      => 'Введите корректный Email.',
    'message.required' => 'Поле "Сообщение" обязательно для заполнения.',
    'message.min'      => 'Сообщение должно содержать минимум 5 символов.',
    'message.max'      => 'Сообщение не должно превышать 500 символов.',
]);
        $dir = storage_path('app/public/data');
        if (!File::exists($dir)) {
            File::makeDirectory($dir, 0755, true);
        }

        $filename = 'data_' . uniqid() . '.json';
        $path = $dir . '/' . $filename;

        File::put($path, json_encode($validated, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));

        return back()->with('success', 'Данные успешно сохранены!');
    }

    public function list()
    {
        $dir = storage_path('app/public/data');
        $items = [];

        if (File::exists($dir)) {
            $files = File::files($dir);
            foreach ($files as $file) {
                $content = json_decode(File::get($file), true);
                if ($content) {
                    $items[] = $content;
                }
            }
        }

        return view('list', ['items' => $items]);
    }
}
