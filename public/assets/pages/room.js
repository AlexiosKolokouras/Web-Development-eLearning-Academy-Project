(function ($){
    $(document).on('submit', 'form.favoriteForm', function(e){
        //Stop default from behavior
        e.preventDefault();

        //Get form data
        const formData = $(this).serialize();

        //Ajax request
        $.ajax(
            'http://hotel.collegelink.localhost/hotels/public/ajax/room_favorite.php',
            {
                type: "POST",
                dataType: "json",
                data: formData
            }).done(function(result){
                const $favoriteStatus = $('#heart').val();
                if($favoriteStatus == 0){
                    $('.heart').addClass('selected');
                }else{
                    $('.heart').removeClass('selected');
                }
                
                if(result.status){
                    $('input[name=is_favorite]').val(result.is_favorite ? 1 : 0);
                }else{
                    $('.heart').toggleClass('selected', !result.is_favorite);
                }
            });
    });

    $(document).on('submit', 'form.reviewForm', function(e){
        //Stop default from behavior
        e.preventDefault();

        //Get form data
        const formData = $(this).serializeArray();

        //Ajax request
        $.ajax(
            'http://hotel.collegelink.localhost/hotels/public/ajax/room_review.php',
            {
                type: "POST",
                dataType: "html",
                data: formData
            }).done(function(result){
                 //Append review to list
                 $('#room-reviews-container').append(result);

                 //Reset review form
                 $('form.reviewForm').trigger('reset');
            });

        //Ajax request
        $.ajax(
            'http://hotel.collegelink.localhost/hotels/public/ajax/room_title_review.php',
            {
                type: "POST",
                dataType: "html",
                data: formData
            }).done(function(result){
                //Clear rate results
                $('#title_reviews').html('');
                
                 //Append rate
                 $('#title_reviews').append(result);
            });
    });
})(jQuery);