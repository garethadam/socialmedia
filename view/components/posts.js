class Posts extends React.Component {

 constructor(props) {
    super(props)
    this.state = {date:date, id:id, posts:posts, comments:comments, images:images, likes:likes, comment:"Enter your comment", post:""}
	 }


	comment(req)
	  {

	  	return <form action="http://localhost/socialmedia/controller/comment.php"  method="post" className="createComment"  enctype='multipart/form-data'>
					<input name="post" id={req} type="hidden" value={req}/>
					<textarea name="comment" id="comment"  placeholder="Enter your Comment" required></textarea>
					<input className="commentSubmit" type="submit" value="comment" />
				</form>
		}
 comments(post)
	{
			  var a
			  var shows=[]
			  var show
			  for(a=0; a<comments.length; a++)
			  {
				if(post==comments[a].post)
				  {

					show=<div className="comments">
							<div className="comment">
									<div className="commentAuthor">
										<img className="commentImage" src={"../images/" + comments[a].profilePic} />
										<p><a href={"profile.php?user=" + comments[a].uid}> {comments[a].user} {comments[a].last} </a></p>
									</div>
									<div className="commentContent">
										<p>{comments[a].comment}</p>
									</div>
								</div>
							</div>
				   shows.push(show)
					}
				  }
			  return (<div>{shows}</div>)
		 }




	Picture(post)
		  {
			  var x
			  var displays=[]
			  var display
			  for(x=0; x< images.length; x++)
			  {
				if(post==images[x].post)
					{
                      var temp="../images/"+images[x].image;
							display=<img src={temp} />
					displays.push(display)
					}
			  }
			  return (<p>{displays}</p>)
		 }


     	like(post)
     		  {
    			  var x
     			  var display = <div className="likeButton" onClick={this.likeClicked.bind(this, post)} id={post}> Like </div>

    			  for(x=0; x< likes.length; x++)
    			  {
       				if(post==likes[x].post)
       					{
                    display=<div className="likeButton liked" onClick={this.likeClicked.bind(this, post)} id={post}> &nbsp; Unlike </div>
                    console.log(likes[x].post)
                      break;
       					}
            }
     			  return (<p>{display}</p>)
     		 }

	likeClicked(post) {
		   $.ajax({
			type: 'GET',
			url: '../../controller/like.php?post=' + post,
            dataType: "text",
			success: function (data)
			{
                console.log("#"+post)

			             $("#"+post).toggleClass('liked')

                         if($("#"+post).hasClass("liked")) {
                             $("#"+post).html("&nbsp;Unlike");
                         } else {
                             $("#"+post).html("Like");
                         }

			}
    	});
	}

  render()
  {
    var photo = document.getElementById('uPhoto').value;
	  var i
	  var items=[]
	  var item
	  var post
	  for (i=0;  i<posts.post.length;  i++)
	  {
		  post=posts.post[i];

		  item=<div className="postDesign" key={i}>
                    <div className="posterInformation" >
                        <img className="posterImage" src={"../images/" + posts.profilePic[i]} />
                        <div className="postDetails">
                            <p><a href={"profile.php?user=" + posts.uid[i]}> {posts.name[i]} {posts.last[i]} </a></p>
                            <p> {posts.postdate[i]} </p>
                        </div>
                    </div>
                    <div className="postButtons">
                        {this.like(post)}
                        <div className="commentButton">
                            Comments
                            <input type="hidden" name="postID" value={posts.post[i]} />
                        </div>
                    </div>
					<div className="postContents">
						<p className="postText"> {posts.text[i]} </p>
						<p className="postImages">{this.Picture(post)}</p>
					</div>
                    <div className="clearall"></div>
                    <div className="allComments">
                          {this.comments(post)}
    					<div className="commentSection" key={i}>
    						<div className="commentForm">
    							<img className="commentProfileImage" src={"../images/" + photo} />
    					  			{this.comment(post)}
    						</div>
    					</div>
                    </div>
                </div>
			 items.push(item)
		}

    return ( <div> {items} </div> )
  }
}


ReactDOM.render(
  <Posts />,
  document.getElementById('posts')
)
