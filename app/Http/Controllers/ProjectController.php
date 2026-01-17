<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('project.index', compact('projects'));
    }
    public function create()
    {
        return view('project.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'Project_Name' => 'required|string|max:255',
            'Project_File_Path' => 'nullable|file',
            'Project_GIS_Shape_File_Path' => 'nullable|file',
        ]);

        $data = $request->only('Project_Name');

        // فایل اپلوډ
        if ($request->hasFile('Project_File_Path')) {
            $data['Project_File_Path'] = $request->file('Project_File_Path')->store('projects/files', 'public');
        }

        if ($request->hasFile('Project_GIS_Shape_File_Path')) {
            $data['Project_GIS_Shape_File_Path'] = $request->file('Project_GIS_Shape_File_Path')->store('projects/gis', 'public');
        }

        Project::create($data);

        return redirect()->route('projects.index')->with('success', 'Project created successfully.');
    }

    public function edit($id)
    {
        $project = Project::find($id);
        return view('project.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'Project_Name' => 'required|string|max:255',
            'Project_File_Path' => 'nullable|file',
            'Project_GIS_Shape_File_Path' => 'nullable|file',
        ]);

        $project->Project_Name = $request->Project_Name;

        if ($request->hasFile('Project_File_Path')) {
            if ($project->Project_File_Path) {
                Storage::disk('public')->delete($project->Project_File_Path);
            }
            $project->Project_File_Path = $request->file('Project_File_Path')->store('projects/files', 'public');
        }

        if ($request->hasFile('Project_GIS_Shape_File_Path')) {
            if ($project->Project_GIS_Shape_File_Path) {
                Storage::disk('public')->delete($project->Project_GIS_Shape_File_Path);
            }
            $project->Project_GIS_Shape_File_Path = $request->file('Project_GIS_Shape_File_Path')->store('projects/gis', 'public');
        }

        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        if ($project->Project_File_Path) {
            Storage::disk('public')->delete($project->Project_File_Path);
        }

        if ($project->Project_GIS_Shape_File_Path) {
            Storage::disk('public')->delete($project->Project_GIS_Shape_File_Path);
        }

        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
