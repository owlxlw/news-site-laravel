<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('pages.home');
    }

    public function about()
    {
        return view('pages.about');
    }

    public function contacts()
    {
        $contacts = [
            'address' => 'г. Москва, ул. Тверская, д. 10, офис 501',
            'phone' => '+7 (495) 123-45-67',
            'email' => 'info@news-site.ru',
            'work_hours' => 'Понедельник - Пятница: 10:00 - 19:00',
            'social' => 'Telegram: @news_site | VK: vk.com/news_site'
        ];
        
        return view('pages.contacts', compact('contacts'));
    }
}
