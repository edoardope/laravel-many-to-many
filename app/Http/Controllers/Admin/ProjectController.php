<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Project;
use App\Models\Admin\Technology;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Type;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();

        if ($user && $user->role == 'admin') {

            $projects = Project::all();

            return view('admin.projects.index', compact('projects'));
        }

        return redirect()->route('403');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();

        $user = auth()->user();

        $technologies = Technology::all();

        if ($user && $user->role == 'admin') {
            return view('admin.projects.create', compact('types', 'technologies'));
        }

        return redirect()->route('403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request);
        $form_data = $request->all();

        $new_project = new Project();

        if ($request->hasFile('cover_image')) {

            $path = Storage::disk('public')->put('post_images', $request->cover_image);
            $form_data['cover_image'] = $path;
        }

        $new_project->fill($form_data);
        $new_project->save();

        if ($request->has('tags')) {
            $new_project->technologies()->attach($request->tags);
        }

        // dd($request);

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $project = Project::findOrFail($id);

        return view('guest.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $types = Type::all();
        $user = auth()->user();

        if ($user && $user->role == 'admin') {

            $project = Project::findOrFail($id);
            return view('admin.projects.edit', compact('project', 'types'));

        }

        return redirect()->route('403');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form_data = $request->all();

        $project = Project::findOrFail($id);

        if ($request->hasFile('cover_image')) {

            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }

            $path = Storage::disk('public')->put('post_images', $request->cover_image);

            $form_data['cover_image'] = $path;
        }

        $project->update($form_data);

        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = auth()->user();

        if ($user && $user->role == 'admin') {
            $project = Project::findOrFail($id);
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $project->delete();

            return redirect()->route('admin.projects.index');
        }

        return redirect()->route('403');
    }
}