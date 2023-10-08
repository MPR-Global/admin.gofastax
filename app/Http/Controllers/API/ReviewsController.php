<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|JsonResponse
     */
    public function index(): Factory|JsonResponse|Application
    {
        $items = Reviews::select('id','name','description','review_date')
            ->orderByDesc('review_date')->paginate(10);
        return response()->json(['message' => 'Reviews', 'data' => compact('items')]);
    }
}
