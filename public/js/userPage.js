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
        popUpPositionButton: "right",
        popUpPositionAlign: "center",
        activateAttr: ".logo-favorite-team-popUp",
        searchActive: true,
        activeBubble: true
    });


    $('body').on('click', '#favorite-team-content .popUpSearch-item-icon', function () {
        $this = $(this);
        var changeImg = $this.attr('data-id-spopup');
        alert(changeImg);
    });

    $('body').on('click', '#account-status .popUpSearch-item-icon', function () {
        $this = $(this);
        var changeImg = $this.attr('data-nom-team');

        $.ajax({
            method: 'POST',
            url: url1,
            data: {imgId: changeImg, _token: token},
            success: function (msg) {
                $("#account-status .header").css('background-image', 'url('+msg.data.avatar_url+')');
                $("#nav-account-icon").css('background-image', 'url('+msg.data.avatar_url+')');
            }
        });

    });

});