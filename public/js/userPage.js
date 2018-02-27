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

    $('body').on('click', '.popUpSearch-item-icon', function () {
        $this = $(this);
        var changeImg = $this.attr('data-nom-team');

        $.ajax({
            method: 'POST',
            url: url1,
            data: {imgId: changeImg, _token: token},
            success: function (msg) {
                console.log(msg.data);
                $("#account-status .header").css('background-image', 'url('+msg.data.avatar_url+')');
                $("#nav-account-icon").css('background-image', 'url('+msg.data.avatar_url+')');
            }
        });

    });

});