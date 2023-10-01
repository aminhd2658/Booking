<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreBookingRequest;
use App\Http\Requests\StoreCommentRequeust;
use App\Models\Room;
use App\Models\Stay;
use App\Services\BookingService;
use App\Services\CommentService;

class CommentsController extends Controller
{


    public function store(StoreCommentRequeust $request, Stay $stay)
    {
        $data = $request->only('content', 'star');
        $data['stay'] = $stay;
        $data['user'] = auth()->user();
        (new CommentService())->create($data);
        return redirect()->back()->with([
            'status' => 'successfully',
            'message' => 'Successfully sent. you can see your comment after admin accepted.'
        ]);
    }

}
