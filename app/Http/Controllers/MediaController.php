<?php

namespace GrahamCampbell\BootstrapCMS\Http\Controllers;

use GrahamCampbell\BootstrapCMS\Models\Media;
use Illuminate\Http\Request;
use GrahamCampbell\BootstrapCMS\Services\MediaService;

class MediaController extends AbstractController
{
    /**
     * @var MediaService
     */
    protected $mediaService;

    /**
     * MediaController constructor.
     *
     * @param MediaService $mediaService
     */
    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;

        parent::__construct();
    }

    /**
     * Upload media files on server
     *
     * @param Request $request
     *
     * @return array
     */
    public function uploadMedia(Request $request)
    {
        $data = $request->all();

        return $this->mediaService->uploadMedia($data['files']);
    }

    /**
     * Show all media files.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showAllMedia()
    {
        return view('media.show', ['files' => Media::all()]);
    }

    /**
     * Delete media file from server.
     *
     * @param $id
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|int|\Symfony\Component\HttpFoundation\Response
     */
    public function deleteMedia($id)
    {
        $media = Media::find($id);

        if ($this->mediaService->deleteMedia($media)) {
            flash()->success('Media was deleted!');

            return $this->response(true);
        }

        flash()->error('Media doesn\'t exist.');

        return $this->response(false);
    }
}