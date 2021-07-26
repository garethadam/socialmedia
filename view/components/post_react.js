class Post extends React.Component {

  constructor(props) {
    super(props)
    this.state = {date:date, id:id, album:album, post:"Enter your Post..."}
  }



	buttonClicked() {
	 $("#images").click();
	 console.log(this.value);
	}


  render() {
          var photo = document.getElementById('uPhoto').value;
    return (
		<div id="postForm">
		<p className="postTitle">Create a post</p>
		<img className="postProfileImg" src={"../images/" + photo} />
		  <form action="http://localhost/socialmedia/controller/post.php" method="post"  id="createPost" name="createPost" encType="multipart/form-data">
				<textarea name="post" id="post" placeholder="Enter your Post" required></textarea>
		  		<div className="postIcons">
					<div id="attachImage" onClick={this.buttonClicked.bind(this)}><input type="file" name="file[]" style={{display: 'none'}} id="images" multiple /><img src="../images/camera.png" /></div>
					<div className="postSettings"><img src="../images/settings.png" /></div>
				</div>
				<div className="postIcons">
					<input className="postSubmit" type="submit" form="createPost" value="Create Post" />
				</div>
		  </form>
	  </div>
    );
  }
}


ReactDOM.render(
  <Post />,
  document.getElementById('post')
);
