


$('.draggable-point').draggable({
    axis: 'x',
    containment: 'parent'
  });
  
  $('.draggable-point').draggable({
      drag: function() {
          var xPos = (100 * parseFloat($(this).css("right"))) / (parseFloat($(this).parent().css("width"))) + "%";
       console.log(xPos);
    }
  });

