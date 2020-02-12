<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function addTaskComment(Request $request){
      $id = $request->user()->id;
      extract($_POST);

      if(!empty($_POST["parent_id"]) && !empty($_POST["task_id"])){

      $comment = Comment::create(['parent_id'=>$parent_id, 'task_id'=>$task_id, 'body'=>$body, 'url'=>$url, 'user_id'=>$id,'commentable_id'=>$commentable_id,'commentable_type'=>$commentable_type,'created_at'=>date('Y-m-d h:i:s'), 'updated_at'=>date('Y-m-d h:i:s')]);

      $message = '<label class="text-success">Comment posted Successfully.</label>';

    	$status = array(
    		'error'  => 0,
    		'message' => $message
    	);
    }
    else{

      $message = '<label class="text-danger">Error: Comment not posted.</label>';

      $status = array(
        'error'  => 1,
        'message' => $message
      );
    }

    echo json_encode($status);

    }

    public function store(Request $request)
    {
         if(Auth::check()){
            $comment = Comment::create([
                'body' => $request->input('body'),
                'url' => $request->input('url'),
                'commentable_type' => $request->input('commentable_type'),
                'commentable_id' => $request->input('commentable_id'),
                'user_id' => Auth::user()->id
            ]);


            if($comment){
                return back()->with('success' , 'Comment created successfully');
            }

        }

            return back()->withInput()->with('errors', 'Error creating new comment');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        //
    }

    public function showComments($id){

      $commentsResult = Comment::leftjoin('users','users.id','=','comments.user_id')->where([['task_id',$id],['parent_id',-1]])->select('comments.id as commentID','comments.*','users.*')->orderby('comments.id','DESC')->get();
      $commentHTML    = '';
      foreach($commentsResult as $comment){


      		$panelColor="panel-info";


      	$commentHTML .= '
      		<div class="panel '.$panelColor.'">

      		<div class="panel-heading">By <b>'.$comment->name.'</b> on <i>'.$comment->created_at.'</i></div>
      		<div class="panel-body">'.$comment->body.'</div>
      		<div class="panel-footer" align="right"><button type="button" class="btn btn-primary reply" id="'.$comment->commentID.'">Reply</button></div>
      		</div> ';



      	$commentHTML .= self::getCommentReply($id,$comment->commentID);
}
echo $commentHTML;
}
public function getCommentReply($id, $parentId = -1, $marginLeft = 0) {


	$commentHTML = '';
	$commentsResult = Comment::leftjoin('users','users.id','=','comments.user_id')->where([['task_id',$id],['parent_id',$parentId]])->select('comments.id as commentID','comments.*','users.*')->orderby('comments.id','DESC')->get();
	$commentsCount = sizeof($commentsResult);

	if($parentId == 0) {
		$marginLeft = 0;
	} else {
		$marginLeft = $marginLeft + 48;
	}
	if($commentsCount > 0) {
		foreach($commentsResult as $comment){

		$panelColor="panel-info";

    $commentHTML .= '
      <div class="panel '.$panelColor.'" style="margin-left:'.$marginLeft.'px">

      <div class="panel-heading">By <b>'.$comment->name.'</b> on <i>'.$comment->created_at.'</i></div>
      <div class="panel-body">'.$comment->body.'</div>
      <div class="panel-footer" align="right"><button type="button" class="btn btn-primary reply" id="'.$comment->commentID.'">Reply</button></div>
      </div> ';



    $commentHTML .= self::getCommentReply($id,$comment->commentID);

		}
	}
	return $commentHTML;
}


}
