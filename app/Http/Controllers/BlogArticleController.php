<?php

namespace App\Http\Controllers;

use App\Models\BlogArticle;
use Illuminate\Http\Request;

class BlogArticleController extends Controller
{
    public function index()
    {
        $blog_articles = BlogArticle::orderBy('flight_date', 'desc')->get();
        return view('welcome', compact('blog_articles'));
    }

    public function show(BlogArticle $blog_article)
    {
        return view('blog-article', compact('blog_article'));
    }
}
