<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/hero', function () {
    return response()->json(\App\Models\Hero::where('is_active', true)->first());
});

Route::get('/about', function () {
    $about = \App\Models\About::where('is_active', true)->first();
    if ($about) {
        return response()->json([
            'title' => $about->title,
            'first_description' => $about->first_description,
            'second_description' => $about->second_description,
            'image' => $about->image,
            'projects_count' => $about->projects_count,
            'years_count' => $about->years_count,
            'workforce_count' => $about->workforce_count,
            'tonnes_saved' => $about->tonnes_saved,
        ]);
    }
    return response()->json(null);
});

Route::get('/achievements', function () {
    return response()->json(\App\Models\Achievement::where('is_active', true)->orderBy('sort_order')->get());
});

Route::get('/testimonials', function () {
    return response()->json(\App\Models\ClientFeedback::where('is_active', true)->get());
});

Route::get('/partners', function () {
    return response()->json(\App\Models\Partner::where('is_active', true)->orderBy('sort_order')->get());
});

Route::get('/company-overview', function () {
    return response()->json(\App\Models\CompanyOverview::where('is_active', true)->first());
});

Route::get('/memberships', function () {
    return response()->json(\App\Models\Membership::where('is_active', true)->orderBy('sort_order')->get());
});

Route::get('/certifications', function () {
    return response()->json(\App\Models\Certification::where('is_active', true)->orderBy('sort_order')->get());
});

Route::get('/leadership', function () {
    return response()->json(\App\Models\Leadership::where('is_active', true)->orderBy('sort_order')->get());
});

Route::get('/mentorships', function () {
    return response()->json(\App\Models\Mentorship::where('is_active', true)->orderBy('sort_order')->get());
});

Route::get('/technical-specializations', function () {
    return response()->json(\App\Models\TechnicalSpecialization::where('is_active', true)->first());
});

Route::get('/expertises', function () {
    return response()->json(\App\Models\Expertise::where('is_active', true)->first());
});

Route::get('/why-chooses', function () {
    return response()->json(\App\Models\WhyChoose::where('is_active', true)->get());
});

Route::get('/careers', function () {
    return response()->json(\App\Models\Career::where('is_active', true)->orderBy('sort_order')->get());
});

Route::get('/latest-news', function () {
    return response()->json(\App\Models\LatestNews::where('is_active', true)->orderBy('sort_order')->get());
});

Route::get('/business-hours', function () {
    return response()->json(\App\Models\BusinessHours::where('is_active', true)->first());
});

Route::get('/get-in-touch', function () {
    return response()->json(\App\Models\GetInTouch::where('is_active', true)->orderBy('sort_order')->get());
});

Route::get('/featured-highlights', function () {
    return response()->json(\App\Models\FeaturedHighlight::where('is_active', true)->orderBy('sort_order')->get());
});

Route::get('/team', function () {
    return response()->json(\App\Models\Team::where('is_active', true)->orderBy('sort_order')->get());
});
