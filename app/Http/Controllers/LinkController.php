<?php

namespace App\Http\Controllers;

use App\Http\Requests\CountRequest;
use App\Http\Requests\StoreLinkRequest;
use App\Http\Resources\LinkResource;
use App\Repositories\Link\LinkRepository;


class LinkController extends Controller
{

    private $linkRepository;

    public function __construct(LinkRepository $linkRepository)
    {
        $this->linkRepository = $linkRepository;
    }

    public function store(StoreLinkRequest $request)
    {
        $user = auth()->user();
        $link = $this->linkRepository->create(['user_id' => $user->id, 'inputed_link' => $request->inputed_link]);
        $this->linkRepository->generateLink($link);

        return new LinkResource($link->fresh());
    }

    public function redirect(string $generated_link)
    {
        $link = $this->linkRepository->redirect($generated_link);
        if (!$link) abort(404);

        return redirect()->away($link->inputed_link);
    }

    public function count(CountRequest $request)
    {
        $output = $this->linkRepository->count(auth()->user(), $request->started_at, $request->ended_at);
        return response()->json($output);
    }

}
