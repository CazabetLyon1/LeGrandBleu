/**
 * Created by jaysonkaced on 07/02/2018.
 */

$('document').ready(function() {

    $('#validerSimulation').click(function() {

        $urlEqu = $('#carouselClubExt .active').attr('id');


        document.location.href = 'statEquipe/' + $urlEqu +  '/2018';
    });

    $('#carouselPaysDom #France').parent().addClass('active');
    requeteAjaxChoixClub('#carouselPaysDom', '#carouselClubDom');

    $('#carouselPaysExt #France').parent().addClass('active');
    requeteAjaxChoixClub('#carouselPaysExt', '#carouselClubExt');

    $('#carouselPaysDom .carousel-control').click(function() {
        setTimeout(function(){

            $pays = $('#carouselPaysDom .active p').text()
            //console.log($pays);

            requeteAjaxChoixClub('#carouselPaysDom', '#carouselClubDom');
        },100);
    });

    $('#carouselPaysExt .carousel-control').click(function() {
        setTimeout(function(){

            $pays = $('#carouselPaysExt .active p').text();
            //console.log($pays);

            requeteAjaxChoixClub('#carouselPaysExt', '#carouselClubExt');
        },100);
    });

    function requeteAjaxChoixClub($carousel1, $carousel2) {
        $.ajax({
            method: 'POST',
            url: url,
            data: {pays: $($carousel1 + ' .active p').attr('id'), _token: token},
            success: function (msg) {
                $($carousel2 + ' .carousel-inner').html('');

                $.each(msg.clubs, function (index, value) {
                    //console.log(value);

                    $($carousel2 + ' .carousel-inner').append(
                        '<div class="item" id="' + value.url_nom + '">' +
                        '<img class="logo-club" src="' + value.url_club + '">' +
                        //'<img class="logo-club" src="2Weeks_Images/Clubs' + value.pays + '/' + value.url_club + '.png">' +
                        '<p>' + value.nom_club +  '</p>' +
                        '</div>'
                    );

                    if (index == 1) {
                        $($carousel2 + ' .carousel-inner').append(
                            '<div class="item active" id="' + value.url_nom + '">' +
                            '<img class="logo-club" src="' + value.url_club + '">' +
                            '<p>' + value.nom_club +  '</p>' +
                            '</div>'
                        );
                    }
                });
            }
        });

    }

});