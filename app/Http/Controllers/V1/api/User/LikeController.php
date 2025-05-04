<?php

namespace App\Http\Controllers\V1\api\User; 
use App\Http\Controllers\Controller; 
use App\Http\Requests\LikePutRequest;
use App\Http\Resources\LikeResource;
use App\Models\Like;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use ResponseTrait;
    public function index()
    {
        $likes = Like::with('product')->where('user_id', auth()->id())->get();
        return $this->success(LikeResource::collection($likes), __('successes.like.all'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(LikePutRequest $request)
    {
        $like = new Like();
        $like->user_id = Auth::id();
        $like->product_id = $request->product_id;
        $like->save();
        return $this->success(new LikeResource($like->load('product')),__('successes.like.liked'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $like = Like::findOrFail($id);
       if (auth()->user()->id !== $like->user_id) {
        return $this->error(__('errors.user'), 403);
    }
       $like->delete();
       return $this->success([],__('successes.like.unlike'),204);
    }
}
