<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviews;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $team = Reviews::query()->orderBy('sequence')->paginate(100);
        return view('reviews.index');
    }

    public function getReviews(Request $request)
    {
        $data = Reviews::select(['id', 'name', 'review_date', 'description', 'image']); // Adjust columns
        $recordsTotal = Reviews::count(); // Total records
        $recordsFiltered = $data->count(); // Records after filtering

        // Filtering
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $data->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('review_date', 'like', '%' . $searchValue . '%');
            });
            if ($request->has('columns') && $request->input('columns.7.search.value') === '1') {
                $data->withTrashed();
            }
            $recordsFiltered = $data->count(); // Records after filtering
        } elseif ($request->has('columns') && $request->input('columns.7.search.value') === '1') {
            // Show soft-deleted records
            $data->onlyTrashed();
            $recordsFiltered = $data->count(); // Records after filtering
        }

        // Sorting
        if ($request->has('order') && count($request->order)) {
            $columnIndex = $request->order[0]['column'];
            $columnName = $request->columns[$columnIndex]['data'];
            $columnDirection = $request->order[0]['dir'];
            $data->orderBy($columnName, $columnDirection);
        }

        // Pagination
        $page = $request->input('start', 0) / $request->input('length', 10) + 1; // Calculate the current page
        $perPage = $request->input('length', 10); // Number of records per page
        $data->skip(($page - 1) * $perPage)->take($perPage);



        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $data->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reviews.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $userId = auth('api')->user()->id;
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'image' => 'required',
                'review_date' => 'required',
            ]);

            $newReview = new Reviews;
            $newReview->name = $request->name;
            $newReview->description = $request->description;
            $newReview->image = $request->image;
            $newReview->review_date = $request->review_date;
            $newReview->created_by = $userId;
            $newReview->save();
        } catch (\Exception $e) {
            Log::error('Something wen wrong while adding new reviews, error:=' . $e->getMessage());
            // return redirect("reviews")->withError('Something went wrong while adding the team member, please contact to admin.');
        }
        return redirect("reviews")->withSuccess('New Review added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Reviews  $Reviews
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Reviews::query()->findOrFail($id);
        return view('reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reviews  $Reviews
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $memberId)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'review_date' => 'required',
        ]);
        $review = Reviews::findOrFail($memberId);
        $review->update($validatedData);
        
        $review->save();

        return redirect()->route('reviews.edit', $review->id)
            ->with('success', 'Review updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Reviews  $Reviews
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Reviews::query()->findOrFail($id)->delete();
        return redirect()->route('reviews', ['page' => request('page')])->with('success', __('Review removed successfully'));
    }

    public function getAllReviews()
    {
        $reviews = Reviews::select('id', 'name', 'description', 'image', 'review_date')->orderBy('id')->get();
        return response()->json(array("message" => "list of all reviews", "data" => $reviews));
    }
}
