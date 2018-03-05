$(function(){
  var nowModalSyncer = null;
  var modalClassSyncer = "book-card";

  var modals = document.getElementsByClassName(modalClassSyncer);

  for(var i=0,l=modals.length; l>i; i++){
    modals[i].onclick = function(){
      this.blur();
      var target = this.getAttribute("data-target");
      if(typeof(target)=="undefined" || !target || target==null){
        return false;
      }

      nowModalSyncer = document.getElementById(target);

      if(nowModalSyncer == null){
        return false;
      }

      if($("#modal-overlay")[0]) return false;

      pointY = $(window).scrollTop();
      $('body').css({
        'position': 'fixed',
        'width': '100%',
        'top': -pointY
      })

      $("body").append('<div id="modal-overlay"></div>');
      $("#modal-overlay").fadeIn("fast");
      $(nowModalSyncer).fadeIn("fast");

      centeringModalSyncer();

      $("#modal-overlay,#modal-close").unbind().click(function(){
        $("#" + target + ",#modal-overlay").fadeOut("fast", function(){
          $('#modal-overlay').remove();

          releaseScrolling();
        });
        nowModalSyncer = null;
      });
    }
  }

  $( window ).resize( centeringModalSyncer ) ;

  function releaseScrolling(){
    $('body').css({
      'position': 'relative',
      'width': '',
      'top': ''
    });
    $(window).scrollTop(pointY);
  }

  function centeringModalSyncer() {

    if(nowModalSyncer == null) return false;

    $(nowModalSyncer).css({"width": 720 + "px","height": 400 + "px","margin": 0,
    "padding": 10 + "px" + " " + 20 + "px","border": 2 + "px" + " " + "solid" + " " + "#aaa",
    "background": "#fff", "position": "fixed", "z-index": 2,
    "left": "calc(" + "(" + 100 + "%" + " - " +  784.5 + "px" + ")" + "/" + 2 + ")","top": 20 + "%"
    });
  }

});
