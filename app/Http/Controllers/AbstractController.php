<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Auth\Blog;
use App\Http\Middleware\Auth\Edit;
use GrahamCampbell\Credentials\Http\Controllers\AbstractController as Controller;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class AbstractController extends Controller
{
    use DispatchesJobs, ValidatesRequests;

    /**
     * A list of methods protected by edit permissions.
     *
     * @var string[]
     */
    protected $edits = [];

    /**
     * A list of methods protected by blog permissions.
     *
     * @var string[]
     */
    protected $blogs = [];

    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        if ($this->edits) {
            $this->middleware(Edit::class, ['only' => $this->edits]);
        }

        if ($this->blogs) {
            $this->middleware(Blog::class, ['only' => $this->blogs]);
        }
    }

    /**
     * @param $status
     * @param array $message
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     */
    public function response($status, $message = [])
    {
        if (!$status) {
            return response()->json(['status' => false, 'errors' => $message], 403);
        }

        return response()->json(['status' => true, 'data' => $message], 200);
    }
}
