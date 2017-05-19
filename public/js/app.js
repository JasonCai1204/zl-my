$(function() {
  var left = $('.tab-bar .left');
  var right = $('.tab-bar .right');
  var leftContent = $('.left-content');
  var rightContent = $('.right-content');
  var loadMoreReviews = $('.more-reviews');
  var doctorId = $('#id').html();

  left.click(function() {
      left.addClass('active');
      right.removeClass('active');

      leftContent.show();
      rightContent.hide();

  });

  right.click(function() {
      right.addClass('active');
      left.removeClass('active');

      rightContent.show();
      leftContent.hide();
  });

  loadMoreReviews.click(function() {

      var skip = $('.review').length;

      $.getJSON("/review/" + doctorId + "/loadMore?skip=" + skip, function(data) {
          var reviews = '';

          if(data.count == 0) {
              loadMoreReviews.hide();
          }

          $.each(data.reviews, function(key, val) {
              var review = '<div class="review"><div class="ratings sum-ratings">';
              for (var i = 0; i < val.ratings; i++) {
                  review += '<span class="star-light"></span>';
              }
              for (var i = 0; i < 5-val.ratings; i++) {
                  review += '<span class="star-outline"></span>';
              }

              review += '<span class="desc">评论人：' + val.patientName + '</span></div>';
              review += '<p>' + val.reviews + '</p></div>';

              reviews += review;
          });

          $('.review:last').after(reviews);
      });
  });

  var $iosDialog1 = $('#iosDialog1');

  $('#dialogs').on('click', '.weui-dialog__btn', function(){
      $(this).parents('.js_dialog').fadeOut(200);
  });

  $('#showIOSDialog1').on('click', function(){
      $iosDialog1.fadeIn(200);
  });

  stars = $('.make-rating .ratings span');
  stars.click(function() {
      clickStars($(this).data('ratings'));
  });

  function clickStars(ratings) {
      $("input[name='ratings']").val(ratings);
      var spans = '';
      for(var i = 0; i < ratings; i++) {
          spans += '<span class="star-light" data-ratings="' + (i + 1) + '"></span>';
      }
      for(var i = 0; i < 5-ratings; i++) {
          spans += '<span class="star-outline" data-ratings="' + (ratings + i + 1) +'"></span>';
      }

      $('.make-rating .ratings').html(spans);
      $('.make-rating .ratings span').click(function() {
          clickStars($(this).data('ratings'));
      });
  }

});
