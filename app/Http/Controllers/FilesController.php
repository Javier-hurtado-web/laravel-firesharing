<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileUploadRequest;
use App\Models\Services\FileService;
use App\Models\Entities\File;


class FilesController extends Controller
{
    /**
     * @var FileService
     */
    protected $fileService;

    /**
     * Create a new controller instance
     *
     * @param FileService $fileService
     */
    public function __construct(FileService $fileService)
    {
        $this->fileService = $fileService;
    }

    /**
     * Upload a new file
     *
     * @param FileUploadRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FileUploadRequest $request)
    {
        $this->fileService->handleUploadedFile($request->file("file"));

        return response()->json(["success" => "success"]);
    }

    /**
     * Show individual file page
     *
     * @param $id File id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $file = File::where("id", $id)->firstOrFail();
        $comments = $file->comments()->where("parent_id", null)->get();

        return view("files.show", ["file" => $file, "comments" => $comments]);
    }

    /**
     * Show last 100 uploaded files
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $lastFiles = File::orderBy("id", "desc")->take(100)->paginate(10);

        return view("files.index", ["files" => $lastFiles]);
    }
}
