<div id="navContainer">
    <nav>
        <div id="navWrap">
            <a href="home.php"><img class="navIcons" alt="Home" src="../images/home.png"></a>

            <div class="dropdown">
                          <img class="navIcons dropbtn" alt="Friend Requests" src="../images/friendRequests.png">
                          <div id="friendsPending" class="dropdown-content">
                              <p class="dropDownText"> No Pending Friends </p>

                              <script type="text/babel">

                              var i;

                              $.ajax({
                                  type: 'GET',
                                  url: '../../controller/find_pending_friends.php?user=<?php echo $_SESSION['userID'] ?>',
                                  dataType: "json",
                                  success: function(data) {

                                      console.log(data);

                                      function PendingFriend(props) {
                                          return (
                                          <div className="dropDownOption">
                                              <img className="dropDownImage" src={"../images/" + props.profilePic}/> <a href={"../html/profile.php?user=" + props.pendingFriendID}><p className="dropDownOptionText"> {props.firstname + " "} {props.lastname} </p></a>
                                              <div className="acceptFriend" onClick={ () => acceptFriend(props.pendingFriendID, <?php echo $_SESSION['userID'] ?>)}></div>
                                              <div className="declineFriend" onClick={ () => actionFriend(props.pendingFriendID, <?php echo $_SESSION['userID'] ?>)}></div>
                                          </div>
                                      );
                                      }

                                      ReactDOM.render(
                                          data.map(function(data, i){
                                              return <PendingFriend pendingFriendID={data[0]} firstname={data[1]} lastname={data[2]} profilePic={data[3]} key={i} />
                                          })
                                          , document.getElementById('friendsPending'));
                                      }
                              });
                              </script>

                          </div>
                        </div>

            <a href="#" class="lastNavIcon"><img class="navIcons comingSoon" alt="Settings" src="../images/settings.png"></a>
            <form id="searchForm" onsubmit="return false;" autocomplete="off" >
                <input id="searchBox" id="searchid" class="search" type="text" placeholder="Search" onkeyup="showResult(this.value)">
                <div id="resultContainer"><div id="result"></div></div>
            </form>
            <input type="hidden" id="uPhoto" name="uPhoto" value="<?php echo $_SESSION['userPhoto'] ?>">
            <a href="profile.php?user=<?php echo $_SESSION['userID'] ?>"><img id="navProfilePic" alt="Profile Picture" src="../images/<?php echo $_SESSION['userPhoto'] ?>"></a>
            <a href="../../controller/logout.php"><img alt="Settings" src="../images/logout.png"></a>
        </div>
    </nav>
</div>
