<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;

class MemberResourceController extends Controller
{
    public function index()
    {
        $resources = Resource::where('status', 'active')
            ->latest()
            ->paginate(10);

        return view('member.resources.index', compact('resources'));
    }

    public function show(Resource $resource)
    {
        return view('member.resources.show', compact('resource'));
    }

    public function download(Resource $resource)
    {
        $resource->increment('download_count');
        return Storage::download($resource->file_path);
    }
}
