
<div id="leftNavBar">
    <div id="leftNavContainer">
        <a href="home.php" alt="Go Home"><img class="sideNavLogo" src="../images/whiteLogo.png"></a>
        <div id="leftNavLinkContainer">

            <a href="profile.php?user=<?php echo $_SESSION['userID'] ?>">
                <div class="navLink">
                    <img class="leftNavIcon" src="../images/<?php echo $_SESSION['userPhoto'] ?>">
                        <p class="leftNavLinkText">My Profile </p></a>
                </div>
            </a>

            <a href="home.php">
              <div class="navLink">
                  <img class="leftNavIcon" src="../images/home.png">
                  <p class="leftNavLinkText"> News Feed </p>
              </div>
            </a>

              <div class="navLink" onclick="displayAllFriends(<?php echo $_SESSION['userID'] ?>)">
                  <img class="leftNavIcon" src="../images/friendRequests.png">
                  <p class="leftNavLinkText"> My Friends </p>
              </div>

              <div class="navLink comingSoon">
                  <img class="leftNavIcon" src="../images/settings.png">
                  <p class="leftNavLinkText"> Settings </p>
              </div>

            <div class="navBarSpacer"></div>
            <div class="sideNavTitle comingSoon">
                My Groups
            </div>
            <div class="navLink comingSoon">
                <img class="leftNavIcon" src="../images/friendRequests.png">
                <p class="leftNavLinkText"> Group One </p>
            </div>
            <div class="navLink comingSoon">
                <img class="leftNavIcon" src="../images/friendRequests.png">
                <p class="leftNavLinkText"> Group Two </p>
            </div>
            <div class="navLink comingSoon">
                <img class="leftNavIcon" src="../images/friendRequests.png">
                <p class="leftNavLinkText"> Group Three </p>
            </div>
            <div class="navBarSpacer"></div>
            <div class="sideNavTitle  comingSoon">
                My Classes
            </div>
            <div class="navLink comingSoon">
                <img class="leftNavIcon" src="../images/search.png">
                <p class="leftNavLinkText"> Class One </p>
            </div>
            <div class="navLink comingSoon">
                <img class="leftNavIcon" src="../images/search.png">
                <p class="leftNavLinkText"> Class Two </p>
            </div>
            <div class="navLink comingSoon">
                <img class="leftNavIcon" src="../images/search.png">
                <p class="leftNavLinkText"> Class Three </p>
            </div>
            <div class="navBarSpacer"></div>
            <div class="sideNavTitle">
                External Links
            </div>
            <a href="http://www.canberra.edu.au/current-students" target="_blank"><div class="navLink">
                <img class="leftNavIcon" src="../images/search.png">
                <p class="leftNavLinkText"> University Website </p>
            </div></a>
            <a href="http://learnonline.canberra.edu.au/my/" target="_blank"><div class="navLink">
                <img class="leftNavIcon" src="../images/search.png">
                <p class="leftNavLinkText"> Moodle </p>
            </div></a>
            <a href="https://www.canberra.edu.au/myuc-u/enrolments-and-timetables/uc-tutorial-system" target="_blank"><div class="navLink">
                <img class="leftNavIcon" src="../images/search.png">
                <p class="leftNavLinkText"> Timetable </p>
            </div></a>
        </div>
    </div>
</div>
