<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Services\BlogServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlogController extends Controller
{
    protected $blogService;

    /**
     * BlogController constructor.
     * @param $blogService
     */
    public function __construct(BlogServiceInterface $blogService)
    {
        $this->blogService = $blogService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function all()
    {
        $blogs = $this->blogService->all();
        return response()->json($blogs, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BlogRequest $request
     * @return void
     */
    public function store(BlogRequest $request)
    {
        if ($request->isFailed()){
            return response()->json($request->getErrorMessage(), 400);
        }
        $data = $request->json()->all();
        if ($this->blogService->store($data)) {
            return response()->json("Create successful", 200);
        } else {
            return response()->json("Create failed", 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $blog = $this->blogService->find($id);
        return response()->json($blog, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BlogRequest $request
     * @param int $id
     * @return void
     */
    public function update(BlogRequest $request, $id)
    {
        if ($request->isFailed()) {
            return response()->json($request->getErrorMessage(), 400);
        }
        $data = $request->json()->all();
        if ($this->blogService->update($data, $id)) {
            return response()->json("Update successful", 200);
        } else {
            return response()->json("Update failed", 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->blogService->delete($id)) {
            return response()->json("Delete successful", 200);
        }
        return response()->json("Delete failed", 500);
    }
}
