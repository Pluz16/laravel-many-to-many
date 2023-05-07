<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    public function index()
{
    $projects = Project::with('type')->get();

    return response()->json([
        'success' => true,
        'data' => $projects
    ]);
}

}
