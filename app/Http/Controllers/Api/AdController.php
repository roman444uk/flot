<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ad\StoreAdRequest;
use App\Models\Ad;
use App\Models\AdPhoto;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ad::with('photos', 'user')->orderBy('id DESC')->paginate(2);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAdRequest $request)
    {
        $validated = $request->validated();

        $ad = new Ad();
        $ad->title = $validated['title'];
        $ad->slug = \Illuminate\Support\Str::slug($validated['title'], '-');
        $ad->user_id = auth()->id();

        if ($ad->save()) {
            foreach ($request->file('photos') as $file) {
                $adPhoto = new AdPhoto();
                $adPhoto->ad_id = $ad->id;
                $adPhoto->url = $file->store('/images/resource', ['disk' =>   'photos']);
                $adPhoto->save();
            }
        }

        return $ad;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        return Ad::where(['slug' => $slug])->with('photos')->firstOrFail();
    }
}
