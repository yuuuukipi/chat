(function() {
  'use strict';

  // var cmds = document.getElementsByClassName('del');
  // var i;

  // console.log(cmds);

  // $(function(){
    setInterval(function(){

      var date=$('.post-date').last();

      // console.log(date[0]);
      if(date[0]==undefined){
          date = "0000-01-01 00:00:00";

      }else{
          date = date[0].innerText.substr(0,19)
      }

      $.ajax({
        url: 'http://localhost:8000/rooms/test',
        type: 'GET',
        dataType: 'json',
        data: {
            id : $('#id').val(),
            date : date
        },
        timeout: 6000,
      })
      .done(function(data) {
          // 通信成功時の処理を記述
          $.each(data[0], function(index) {
            console.log(data[0]);
            var username;
            var userid;
            $.each(data[1], function(index2){
              if(data[1][index2].id==data[0][index].user_id){
                username=data[1][index2].name;
                userid=data[1][index2].id;

              }
            });

            // console.log(nl2br(data[0][index].comment));
            var host = location.host

            $('.comment').append(
              "<div class='media'>" +
              "<div class='media-left'>" +
                "<a href=" +'http://' + host + '/users/' + userid + " class='icon-rounded'>" + username + "</a></div>"+
              "<div class='card col-md-8' style='background-color: aliceblue;'>"+ data[0][index].comment+
              "<div class='text-right post-date'>"+(data[0][index].created_at) + "</div>" + "</div>" + "</div>" + "<br>"
            );

          });

          //下にスクロール
          var a = document.documentElement;
          var y = a.scrollHeight - a.clientHeight;
          window.scroll(0, y);



      })
      .fail(function() {
          // 通信失敗時の処理を記述
      });


    },6000);

})();
