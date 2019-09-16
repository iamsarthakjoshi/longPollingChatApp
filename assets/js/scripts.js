/*
 ██████ ██    ██ ███████ ████████  ██████  ███    ███     ███████  ██████ ██████  ██ ██████  ████████
██      ██    ██ ██         ██    ██    ██ ████  ████     ██      ██      ██   ██ ██ ██   ██    ██
██      ██    ██ ███████    ██    ██    ██ ██ ████ ██     ███████ ██      ██████  ██ ██████     ██
██      ██    ██      ██    ██    ██    ██ ██  ██  ██          ██ ██      ██   ██ ██ ██         ██
 ██████  ██████  ███████    ██     ██████  ██      ██     ███████  ██████ ██   ██ ██ ██         ██
*/

/* Declare */
var semester = "";
semester = $('#fetch_sem').val();
var url = window.location.host;

jQuery(document).ready(function(){
  /* Fullscreen background */
  $.backstretch("http://"+ url + "/phplongpollingbysj/assets/images/background/gaussian.jpg");

  /* Display - hide semester option */
  $("#sign_in_as").change(function(){
    if($(this).val() == 2){
      $("#semester").show();
    } else{
      $("#semester").hide();
    }
  });

  /* Check if username is already regetered in database */
  $("#uname").keyup(function(){
    var username = $('#uname').val();
    var queryString = {'username' : username};
    // alert(username);
    $.ajax({
      type:'GET',
      url:'http://' + url + '/phplongpollingbysj/api/check_username.php',
      data: queryString,
      success:function(result){
        if(result == "exists"){
          $("#userexists").html("Username already exists.");
          $(".change").prop('disabled', true); // disable button
          // alert("ajax success = exists");
        }else{
          $("#userexists").html("");
          $(".register").prop('enable', true);
        }
      },
      error:function(result){
      }
    });
  });
});

$(window).load(function() {
  // Animate loader off screen
  $(".se-pre-con").fadeOut("slow");
});

/**
* Pure AJAX long-polling
*
* 1. sends a request to the server (without a timestamp parameter)
* 2. waits for an answer from server.php and user_online.php (which can take forever)
* 3. if server.php and user_online.php responds (whenever), put data_from_file into #response
* 4. and call the function again
*
* @param timestamp
*/
function getContent(timestamp)
{
  var queryString = {'timestamp' : timestamp};

  $.ajax({
    type: 'GET',
    url: 'http://' + url + '/phplongpollingbysj/api/server.php',
    data: queryString,
    success: function(data){
      // put result data into "obj"
      var obj = jQuery.parseJSON(data);

      // put the data_from_file into #response
      var data = obj.data_from_file;

      document.getElementById("chatBox").innerHTML = "";


      $('#chatBox').append(data);


      // call the function again, this time with the timestamp we just got from server.php
      getContent(obj.timestamp);
      // if($("chatBox").length){
      $('#chatBox').scrollTop($('#chatBox')[0].scrollHeight);
      // }
    }
  });
}

function getPrivateContent(timestamp)
{
  var queryString = {'timestamp' : timestamp, 'semester' : semester};

  $.ajax({
    type: 'GET',
    url: 'http://'+ url + '/phplongpollingbysj/api/server_priv.php',
    data: queryString,
    success: function(data){
      // put result data into "obj"
      var obj = jQuery.parseJSON(data);

      // put the data_from_file into #response
      var data = obj.data_from_file;

      // if($("pvtChatBox").length){
      document.getElementById("pvtChatBox").innerHTML = "";
      // }

      // $.each(data.split(/\|/), function (i, val) {
      $('#pvtChatBox').append(data);
      // });

      // call the function again, this time with the timestamp we just got from server.php
      getPrivateContent(obj.timestamp);
      // if($("chatBox").length){
      $('#pvtChatBox').scrollTop($('#pvtChatBox')[0].scrollHeight);
      // }
    }
  });
}

function getOnlineUsers(timestamp){
  var queryString = {'timestamp' : timestamp};

  $.ajax({
    type: 'GET',
    url: 'http://'+ url + '/phplongpollingbysj/api/user_online.php',
    data: queryString,
    success: function(data){
      // put result data into "obj"
      var obj = jQuery.parseJSON(data);

      // put the data_from_file into #response
      var data = obj.data_from_file;

      if($("#onlineUsers").length){
        document.getElementById("onlineUsers").innerHTML = "";
      }

      $.each(data.split(/\|/), function (i, val) {
        var test = $('#onlineUsers').append(val);
        // console.log(val);
      });

      // call the function again, this time with the timestamp we just got from user_online.php
      getOnlineUsers(obj.timestamp);
      // $('#onlineUsers').scrollTop($('#onlineUsers')[0].scrollHeight);
    }
  });
}

function postContent(message,username){
  var msg = message;

  String.prototype.repeat = function(num){
    return new Array(num + 1).join(this);
  }

  var filter = ['ass', 'swear', 'fuck'];

  /* Iterate over all words */
  for(var i=0; i<filter.length; i++){
    /* Create a regular expression and make it global */
    var pattern = new RegExp('\\b' + filter[i] + '\\b', 'g');

    /* Create a new string filled with '*' */
    var replacement = '*'.repeat(filter[i].length);

    msg = msg.replace(pattern, replacement);
  }

  queryString = {"message" : msg, "username" : username};
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'http://'+ url + '/phplongpollingbysj/api/writeFile.php',
    data: queryString,
    success: function(data){
      if(data == "true"){
        return true;
      }
    }
  });
}

function postPrivateContent(message,username){
  var msg = message;

  String.prototype.repeat = function(num){
    return new Array(num + 1).join(this);
  }

  var filter = ['ass', 'swear', 'fuck'];

  /* Iterate over all words */
  for(var i=0; i<filter.length; i++){
    /* Create a regular expression and make it global */
    var pattern = new RegExp('\\b' + filter[i] + '\\b', 'g');

    /* Create a new string filled with '*' */
    var replacement = '*'.repeat(filter[i].length);

    msg = msg.replace(pattern, replacement);
  }

  queryString = {"message" : msg, "username" : username, "semester" : semester};
  $.ajax({
    type: 'GET',
    dataType: 'json',
    url: 'http://'+ url + '/phplongpollingbysj/api/writePrivFile.php',
    data: queryString,
    success: function(data){
      if(data == "true"){
        return true;
      }
    }
  });
}

// initialize jQuery
$(function() {
  getContent();
  getPrivateContent();
  getOnlineUsers();

  $("#doClick").click(function(){
    var message = $("#entry").val();
    var username = $("#uname").val();
    postContent(message, username);
    $("#entry").val('');
  });

  $("#entry").keyup(function(e){
    if(e.keyCode == 13){
      e.preventDefault();
      $("#doClick").click();
    }
  });

  $("#doClickPriv").click(function(){
    var message = $("#entryPriv").val();
    var username = $("#uname").val();
    postPrivateContent(message, username);
    $("#entryPriv").val('');
  });

  $("#entryPriv").keyup(function(e){
    if(e.keyCode == 13){
      e.preventDefault();
      $("#doClickPriv").click();
    }
  });
});
