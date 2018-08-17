(function() {
  'use strict';

  var cmds = document.getElementsByClassName('del');
  var i;

  console.log(cmds);

  for (i = 0; i < cmds.length; i++){
    cmds[i].addEventListener('click', function(e) {
      e.preventDefault();
      if (confirm('削除しますか?')){
        document.getElementById('form_' + this.dataset.id).submit();
      } else {


        $.ajax({
          url: 'http://localhost:8000/rooms/test',
          type: 'GET',
          dataType: 'json',
          data: {id:"11"}
          //data: $('form').serializeArray(),
          timeout: 5000,
        })
        .done(function(data) {
            // 通信成功時の処理を記述
            alert(data);
        })
        .fail(function() {
            // 通信失敗時の処理を記述
        });



      }
    });
  }

})();


//
// $(function() {
//     $('.btn').on('click', function() {
//         $('.btn').hide();
//         $('.loading').show();
//     });
// });
