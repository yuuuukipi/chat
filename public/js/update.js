(function() {
  'use strict';

  var cmds = document.getElementsByClassName('del');
  var i;

  console.log(cmds);

  // $(function(){
    setInterval(function(){

      var date=$('.post-date').last();
      // console.log(date[0].innerText.substr(0,19));
      date = date[0].innerText.substr(0,19)
      console.log(date);

      $.ajax({
        url: 'http://localhost:8000/rooms/test',
        type: 'GET',
        dataType: 'json',
        data: {
            id : $('#id').val(),
            date : date
        //   id : $("input[name=id]").val(),
        },
        // hidden  : $("input[name=id]").val(),
        // data: $('form').serializeArray(),
        timeout: 5000,
      })
      .done(function(data) {
          // 通信成功時の処理を記述
          // alert(data);
          $.each(data[0], function(index) {
            // console.log(data);
            // alert(date(data[index].created_at));

            // $('.comment').append(
            //   "<div class='card col-md-8' style='background-color: aliceblue;'>data[index].comment</div>");
            console.log(data[0]);
            var username;
            var userid;
            $.each(data[1], function(index2){
              if(data[1][index2].id==data[0][index].user_id){
                // console.log(data[1][index2].name);
                username=data[1][index2].name;
                userid=data[1][index2].id;
                // console.log(username);

              }
            });

            console.log(location.host);
            var host = location.host

            $('.comment').append(
              "<div class='media'>" +
              "<div class='media-left'>" +
                // "<a href= {{ " + action('UsersController@show', userid) + "}} class='icon-rounded'></a></div>"+
                "<a href=" +'http://' + host + '/users/' + userid + " class='icon-rounded'>" + username + "</a></div>"+
               // "<a href=" +'http://' + host + '/users/' + userid + "?#a" + data[0][index].id + " class='icon-rounded'>" + username + "</a></div>"+
              "<div class='card col-md-8' style='background-color: aliceblue;'>"+ data[0][index].comment+
              "<div class='text-right post-date'>"+(data[0][index].created_at) + "</div>" + "</div>" + "</div>" + "<br>"
            );

          });

          $('body').delay(100).animate({
            scrollTop: $(document).height()
          },1500);


      })
      .fail(function() {
          // 通信失敗時の処理を記述
      });


    },5000);
  // });

})();


//
// $(function() {
//     $('.btn').on('click', function() {
//         $('.btn').hide();
//         $('.loading').show();
//     });
// });
