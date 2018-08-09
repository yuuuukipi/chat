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
      }
    });
  }

})();

$(function() {
    $('.btn').on('click', function() {
        $('.btn').hide();
        $('.loading').show();
    });
});
