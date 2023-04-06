window.back_to_top_is_showen=false;
window.addEventListener('scroll', function() {
  if(pageYOffset > 310) {
    document.getElementById('back_to_top').style.display='block';
    back_to_top_is_showen=true;
  } else {
    if (back_to_top_is_showen) {
      document.getElementById('back_to_top').style.display='none';
      back_to_top_is_showen=false;
    } 
  }
});
function scrollToTop(scrollDuration) {
  var scrollStep = -window.scrollY / (scrollDuration / 15),
  scrollInterval = setInterval(function(){
    if ( window.scrollY != 0 ) {
      window.scrollBy( 0, scrollStep );
    }
    else clearInterval(scrollInterval); 
  },15);
}
function backToTop() {
  scrollToTop(7);
}