<?php

namespace App\Http\Controllers;

use App\Models\MeetTheTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use DataTables; // Add this at the top of your controller file
class MeetTheTeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $team = MeetTheTeam::query()->orderBy('sequence')->paginate(100);
        return view('meet_the_team.index');
    }

    public function getTeamData(Request $request)
    {
        $data = MeetTheTeam::select(['id', 'name', 'title', 'sequence', 'profile_img', 'leave_me_review_link', 'review_link', DB::raw('CASE WHEN deleted_at IS NULL THEN "Active" ELSE "Deleted" END as status')]); // Adjust columns
        $recordsTotal = MeetTheTeam::count(); // Total records
        $recordsFiltered = $data->count(); // Records after filtering

        // Filtering
        if ($request->has('search') && !empty($request->search['value'])) {
            $searchValue = $request->search['value'];
            $data->where(function ($query) use ($searchValue) {
                $query->where('name', 'like', '%' . $searchValue . '%')
                    ->orWhere('title', 'like', '%' . $searchValue . '%')
                    ->orWhere('sequence', 'like', '%' . $searchValue . '%');
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
        } else {
            $data->orderBy('sequence');
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
        return view('meet_the_team.add');
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
            $request->validate([
                'name' => 'required',
                'title' => 'required',
                'sequence' => 'required|integer',
                'review_link' => 'required',
                'leave_me_review_link' => 'required',
                'profile_img' => 'required_without:profile_img_link|image|nullable',
                'profile_img_link' => 'required_without:profile_img',
            ]);

            $teamMember = new MeetTheTeam;
            $teamMember->name = $request->name;
            $teamMember->title = $request->title;
            $teamMember->sequence = $request->sequence;
            $teamMember->review_link = $request->review_link;
            $teamMember->leave_me_review_link = $request->leave_me_review_link;
            if ($request->hasFile('profile_img')) {
                $image = $request->file('profile_img');
                $imgPath = Storage::disk('s3')->putFile('Headshots-images', $image);
                $imageName = Storage::disk('s3')->url($imgPath);
                $teamMember->profile_img = $imageName;
            } else {
                $teamMember->profile_img = $request->profile_img_link;
            }
            $teamMember->save();
        } catch (\Exception $e) {
            Log::error('Something wen wrong while adding new team member to meet the team table, error:=' . $e->getMessage());
            // return redirect("meetTheTeam")->withError('Something went wrong while adding the team member, please contact to admin.');
        }
        return redirect("meetTheTeam")->withSuccess('New Team Member added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MeetTheTeam  $meetTheTeam
     * @return \Illuminate\Http\Response
     */
    public function activate(Request $request, $id)
    {
        try {
            $teamMember = MeetTheTeam::withTrashed()->findOrFail($id);
            $teamMember->restore();
            return redirect()->route('meettheteam', ['page' => request('page')])->with('success', __('Member Activated successfully'));
        } catch (\Exception $e) {
            Log::error('something went wrong while activating team member, error=' . $e->getMessage());
            return redirect()->route('meettheteam', ['page' => request('page')])->with('error', __('Member Activation failed'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MeetTheTeam  $meetTheTeam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teamMember = MeetTheTeam::query()->findOrFail($id);
        return view('meet_the_team.edit', compact('teamMember'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MeetTheTeam  $meetTheTeam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $memberId)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'title' => 'required',
            'sequence' => 'required|integer',
            'review_link' => 'required',
            'leave_me_review_link' => 'required',
            'profile_img_new' => 'nullable|image',
        ]);
        $teamMember = MeetTheTeam::findOrFail($memberId);
        $teamMember->update($validatedData);
        // dd($teamMember);
        if ($request->hasFile('profile_img_new')) {
            $image = $request->file('profile_img_new');
            $imgPath = Storage::disk('s3')->putFile('Headshots-images', $image);
            $imageName = Storage::disk('s3')->url($imgPath);
            $teamMember->profile_img = $imageName;
        }
        $teamMember->save();

        return redirect()->route('meettheteam.edit', $teamMember->id)
            ->with('success', 'Team Member updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MeetTheTeam  $meetTheTeam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        MeetTheTeam::query()->findOrFail($id)->delete();
        return redirect()->route('meettheteam', ['page' => request('page')])->with('success', __('Member removed successfully'));
    }

    public function getAllTeamMembers()
    {
        $team = MeetTheTeam::select('id', 'name', 'title', 'profile_img', 'review_link', 'leave_me_review_link')->orderBy('sequence')->get();
        return response()->json(array("message" => "list of all team members", "data" => $team));
    }
}
