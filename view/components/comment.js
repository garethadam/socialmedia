export class comments extends React.Component {
	constructor(props)
	{
    super(props)
	index=this.props.i
    this.state = {date:date, user:id, posts:posts, comment:"Enter your comment"}
  	}
	comment(index)
	{
		if (post.commentText!="")
		{
		return
							<div className="comments">
								<div className="comment">
									<div className="commentAuthor">
										<img className="commentImage" src="../images/profile.jpg" />
										<p> Aaron Ward {posts[index].commentUser}</p>
									</div>
									<div className="commentContent">
										<p>{posts[index].commentText}</p>
									</div>
								</div>
							</div>;
		 }

	}

	comments(index)
	{
		return
					<div className="commentSection">
							 <div className="commentForm">
							  <img className="commentProfileImage" src="../images/profile.jpg" />
							  <form action="http://localhost/socialmedia/controller/comment.php" method="post"  className="createComment" name="createComment">
								<input name="date" type="hidden" defaultValue={this.state.date} />
								<input name="id" type="hidden" defaultValue={this.state.id} />
								<input name="postID" type="hidden" defaultValue={posts[index].post} />
								  <textarea name="comment" defaultValue={this.state.comment}> {this.state.comment} </textarea>
								  <input className="commentSubmit" type="submit" form="createComment" />
							  </form>
							  </div>
					</div>
		}

	 render()
	 {
	  return 	<div><comment index={this.props.index} /> <comments index={this.props.index} /> </div>;

	}
}
