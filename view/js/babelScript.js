//Populating the side friends on profile pagesBackground
function displayProfileFriends(user, userID) {
    var i;

    console.log(user + " " + userID);

    if (user == userID) {
        $.ajax({
            type: 'GET',
            url: '../../controller/find_friends.php?user=' + user,
            dataType: "json",
            success: function(data) {

                console.log(data);

                function Friend(props) {
                    return (
                            <div className="aFriend">
                                <a className="aFriendLink" href={"profile.php?user=" + props.userid}><img className="aFriendImage" src={"../images/" + props.photo}></img></a>
                                <div className="aFriendDetails">
                                    <a className="aFriendLink" href={"profile.php?user=" + props.userid}>
                                    <h3>{props.firstname} {props.lastname}</h3>
                                    <h3>{props.email} </h3>
                                    </a>
                                </div>
                                <button className="deleteFriend" onClick={ () => unFriend(props.userid, userID)}></button>
                            </div>
                );
                }

            ReactDOM.render(
                data.map(function(data, i){
                    if (i > 9) {
                        return null
                    }
                    else
                    {
                    return <Friend userid={data[0]} firstname={data[1]} lastname={data[2]} email={data[3]} photo={data[4]} key={i} />
                    }
                })
                , document.getElementById('friendsList'));
            }
        });
    }
    else
    {
        $.ajax({
            type: 'GET',
            url: '../../controller/find_friends.php?user=' + user,
            dataType: "json",
            success: function(data) {

                console.log(data);

                function Friend(props) {
                    return (
                        <a className="aFriendLink" href={"profile.php?user=" + props.userid}>
                            <div className="aFriend">
                                <img className="aFriendImage" src={"../images/" + props.photo}></img>
                                <div>
                                    <h3>{props.firstname} {props.lastname}</h3>
                                    <h3>{props.email} </h3>
                                </div>
                            </div>
                        </a>
                );
                }

            ReactDOM.render(
                data.map(function(data, i){
                    if (i > 9) {
                        return null
                    }
                    else
                    {
                    return <Friend userid={data[0]} firstname={data[1]} lastname={data[2]} email={data[3]} photo={data[4]} key={i} />
                    }
                })
                , document.getElementById('friendsList'));
            }
        });
    }
}

//Populating the Friends popup
function displayAllFriends(user) {

    $("#friendsPopWrap").fadeIn("slow");

    var i;
    $.ajax({
        type: 'GET',
        url: '../../controller/find_friends.php?user=' + user,
        dataType: "json",
        success: function(data) {

            console.log(data);

            function AllFriend(props) {
                return (
                    <a className="allFriendLink" href={"profile.php?user=" + props.userid}>
                        <div className="allFriend">
                            <img className="allFriendImage" src={"../images/" + props.photo}></img>
                            <div>
                                <h3>{props.firstname} {props.lastname}</h3>
                            </div>
                        </div>
                    </a>
            );
            }

            ReactDOM.render(
                data.map(function(data, i){
                    return <AllFriend userid={data[0]} firstname={data[1]} lastname={data[2]} email={data[3]} photo={data[4]} key={i} />
                })
                , document.getElementById('fContent'));
            }
    });
}

//Populating the Friends popup
function populateAlbums(user) {

    $("#albumPopWrap").fadeIn("slow");

    var i;
    $.ajax({
        type: 'GET',
        url: '../../controller/find_albums.php?user=' + user,
        dataType: "json",
        success: function(data) {

            console.log(data);

            function Album(props) {
                return (
                    <div className="aAlbum">
                        <img className="aAlbumImage" src={"../images/" + props.image}></img>
                    </div>
            );
            }

            ReactDOM.render(
                data.map(function(data, i){
                    return <Album image={data[1]} postid={data[4]} key={i} />
                })
                , document.getElementById('aContent'));
            }
    });
}
