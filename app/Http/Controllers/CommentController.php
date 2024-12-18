<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
  public function store(Request $request)
  {
    $this->validate($request, [
      'rating' => 'required',
      'idProduct' => 'required',
      'content'=>'required|max:300'
    ],[
      'rating.required' => 'Bạn cần đánh giá sao.',
      'content.required' => 'Bạn cần nhập nội dung sao.',
      'content.max' => 'Nội dung tối đa 300 kí tự.'
    ]);
    Comment::create([
      'rating' => $request->rating,
      'idProduct' => $request->idProduct,
      'content' => $request->content,
      'idUser' => Auth::user()->id
    ]);
    toastr()->success('Successfully', 'Đánh giá thành công');
    return redirect()->route('detailProduct', $request->idProduct);
  }
}