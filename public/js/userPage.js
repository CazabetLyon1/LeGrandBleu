$('document').ready(function(){
    console.log(url);
    $('body').searchPopUp_plugin({
        dataUrl:url,
        mainContainer: '#account-status',
        needActivate: true,
        popUpPositionButton: "bottom",
        popUpPositionAlign: "center",
        searchActive: false,
        activeBubble: false
    });

    

});