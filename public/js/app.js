$(function() {
  var left = $('.tab-bar .left');
  var right = $('.tab-bar .right');
  var leftContent = $('.left-content');
  var rightContent = $('.right-content');
  var moreReviews = $('.more-reviews');

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

  moreReviews.click(function() {
      console.log('click more reviews button.')
  });

});
