$('document').ready(function(){
    var popUp = $('body').searchPopUp_plugin({
        dataUrl:url,
        mainContainer: '#account-status',
        needActivate: true,
        popUpPositionButton: "bottom",
        popUpPositionAlign: "center",
        searchActive: false,
        activeBubble: false
    });

    $('body').searchPopUp_plugin({
        dataUrl:url2,
        mainContainer: '#favorite-team-content',
        needActivate: true,
        popUpPositionButton: "bottom",
        popUpPositionAlign: "center",
        activateAttr: ".logo-favorite-team-popUp",
        searchActive: true,
        activeBubble: true
    });


    $('body').on('click', '#favorite-team-content .popUpSearch-item-icon', function () {
        $this = $(this);
        var changeImg = $this.attr('data-id-spopup');

        $.ajax({
            method: 'POST',
            url: url3,
            data: {club_id: changeImg, _token: token},
            success: function (msg) {
                $('#favorite-team-content .logo-favorite-team').css('background-image', 'url("'+msg.data.url_club+'")');
                $('#favorite-team-content .name-favorite-team').text(msg.data.nom_club);
                $('#favorite-team-content .country-favorite-team').text(msg.data.pays+' - '+msg.data.nom_ville);
                $('#favorite-team-content .att-def-favorite-team span:nth-child(1)').text(msg.data.attEquipe);
                $('#favorite-team-content .att-def-favorite-team span:nth-child(2)').text(msg.data.defEquipe);

            }
        });
    });

    $('body').on('click', '#account-status .popUpSearch-item-icon', function () {
        $this = $(this);
        var changeImg = $this.attr('data-nom-team');

        $.ajax({
            method: 'POST',
            url: url1,
            data: {imgId: changeImg, _token: token},
            success: function (msg) {
                $("#account-status .header").css('background-image', 'url("'+msg.data.avatar_url+'")');
                $("#nav-account-icon").css('background-image', 'url('+msg.data.avatar_url+')');
            }
        });

    });

});