/**
 * Created by jaysonkaced on 07/02/2018.
 */

$('document').ready(function() {


    $('#carouselPaysDom #FranceDom').parent().addClass('active');
    requeteAjaxChoixClub();

    $('#carouselPaysDom .carousel-control').click(function() {
        setTimeout(function(){

            $pays = $('#carouselPaysDom .active p').text();
            //console.log($pays);

            requeteAjaxChoixClub();
        },100);
    });

    function requeteAjaxChoixClub() {
        $.ajax({
            method: 'POST',
            url: url,
            //data: {pays: $('#carouselPays .active p').attr('id')},
            data: {pays: $('#carouselPaysDom .active p').attr('id'), _token: token},
            success: function (msg) {
                $('#myCarousel2 .carousel-inner').html('');

                $.each(msg.clubs, function (index, value) {
                    //console.log(value);

                    $('#myCarousel2 .carousel-inner').append(
                        '<div class="item">' +
                        '<img class="logo-club" src="2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png">' +
                        '<p>' + value.nom_club + '</p>' +
                        '</div>'
                    );

                    if (index == 1) {
                        $('#myCarousel2 .carousel-inner').append(
                            '<div class="item active">' +
                            '<img class="logo-club" src="2Weeks_Images/Clubs/Ligue1/Olympique_lyonnais.png">' +
                            '<p>' + value.nom_club + '</p>' +
                            '</div>'
                        );
                    }
                });
            }
        });

    }

});