(function ($){
    $(document).on('submit', 'form.searchForm', function(e){
        //Stop default from behavior
        e.preventDefault();

        //Get form data
        const formData = $(this).serialize();

        //Ajax request
        $.ajax(
            'http://hotel.collegelink.localhost/hotels/public/ajax/search_results.php',
            {
                type: "GET",
                dataType: "html",
                data: formData
            }).done(function(result){
                //Clear results container
                $('#search-result-container').html('');

                //Append results to container
                $('#search-result-container').append(result);

                //Push url state
                history.pushState({}, '', 'http://hotel.collegelink.localhost/hotels/public/assets/list.php?' + formData);
            });
    });
})(jQuery);