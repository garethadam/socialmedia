$("#registerRedirect").click(function() {
    $("#loginFormContainer").fadeOut("slow", function() {
        $("#registerFormContainer").fadeIn("slow");
    });
});

$("#loginRedirect").click(function() {
    $("#registerFormContainer").fadeOut("slow", function() {
        $("#loginFormContainer").fadeIn("slow");
    });
});

$("#friendsPopup").click(function() {
        $("#friendsPopWrap").fadeOut("slow");
});

$("#albumPopup").click(function() {
        $("#albumPopWrap").fadeOut("slow");
});

$("#searchBox").blur(function() {
    $("#result").delay(500).fadeOut();
});

$(document).ready(function() {
    $("#sessionMessage").delay(3000).fadeOut("slow");
    $("#sessionMessageError").delay(3000).fadeOut("slow");

  $(".commentButton").click(function() {
    $(this).parent().parent().find(".allComments").toggle();
  });
});

$(".changeProfilePicture").click(function() {
    $("#profileData").trigger('click');
});

$("#profileData").change(function() {
    $("#changePic").trigger('click');
});



function addPendingFriend(userOne, userTwo) {
  var i;

  $.ajax({
      type: 'POST',
      url: '../../controller/add_pending_friend.php?userOne=' + userOne + '&userTwo=' + userTwo,
      dataType: "json",
      success: function(data) {}
  });

  location.reload();
}

function acceptFriend(userOne, userTwo) {
  var i;

  $.ajax({
      type: 'POST',
      url: '../../controller/accept_friend.php?userOne=' + userOne + '&userTwo=' + userTwo,
      dataType: "json",
      success: function(data) {
      }
  });

  location.reload();


}

function actionFriend(userOne, userTwo, pendingFriendID) {
  var i;

  $.ajax({
      type: 'POST',
      url: '../../controller/decline_friend.php?userOne=' + userOne + '&userTwo=' + userTwo,
      dataType: "json",
      success: function(data) {}
  });

  location.reload();
}

function unFriend(userID, friend) {

  var i;

  $.ajax({
      type: 'POST',
      url: '../../controller/block_friend.php?friendID=' + userID + '&friend=' + friend,
      dataType: "json",
      success: function(data) {}
  });

  location.reload();
}
