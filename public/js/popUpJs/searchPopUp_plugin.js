
// project: popUpSearch_plugin
// author: Thibaud PERRIN
// date: 08/12/2017
//
// description:
// jquery version:
//
(function ( $ ) {
 
    $.fn.searchPopUp_plugin = function( options ) {
        // Default options
        var defaults  = {
			dataUrl: "#",
			mainContainer:  'body',
			popUpPositionButton: "right",
			popUpPositionAlign: "start",
			activateAttr: ".popUpSearch_activator",
			needActivate: false,
			searchActive: true,
			activeBubble: true
		};

        var settings = $.extend( {}, defaults, options );
 		
 		return this.each(function(){

            var OL = {
				nom : "Olympique Lyonnais",
				img : "img/Olympique_lyonnais_(logo).svg.png"
			};
			var OM = {
				nom : "Olympique de Marseille",
				img : "img/Logo_Olympique_de_Marseille.svg.png"
			};
			var PSG = {
				nom : "Paris Saint Germain",
				img : "img/520px-Paris_Saint-Germain_Logo.svg.png"
			};

			var data = [OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG,OL, OM, PSG];



			var activationToggle = false;
			var actPos = $(settings.activateAttr).position();
            var typingTimer;                //timer identifier
            var doneTypingInterval = 50000;  //time in ms, 5 second for example
            var entityMap = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#39;',
                '/': '&#x2F;',
                '`': '&#x60;',
                '=': '&#x3D;'
            };

            initAll();

            $(window).click(function () {
                closeSearchPopUp();
            });

			function initAll(){
                createBase();
				needActivation();
				if(settings.activeBubble){
                    bubbleName();
                }
				if(settings.searchActive){
                    search();
                }else{
                    directAffiche();
				}
			}

            function escapeHtml(string) {
                return String(string).replace(/[&<>"'`=]/g, function (s) {
                    return '\\'+entityMap[s];
                });
            }
			function directAffiche(){
                $('body').on('click', ''+settings.mainContainer+' '+settings.activateAttr, function () {
                    removeContent();
                    $.ajax({
						method: 'POST',
						url: settings.dataUrl,
						data: {_token: token},
						success: function (msg){
							drawIcon(msg.data);
						}
					});
                });

			}
			function closeSearchPopUp(){
                $(settings.mainContainer+' .popUpSearch').css('display', 'none');
                activationToggle = false;
            }
            function openSearchPopUp(){
                $(settings.mainContainer+' .popUpSearch').css('display', 'block');
                activationToggle = true;
            }

                function needActivation(){
				if(settings.needActivate){
					$(settings.mainContainer+' .popUpSearch').css('display', 'none');
					positionButtonPopUp();
					$('body').on('click', settings.activateAttr, function(e){
						if(activationToggle){
                            closeSearchPopUp();
						}else{
                            openSearchPopUp();
						}
                        e.stopPropagation();
                    });
					//pour ne pas fermer le popup lorsque l'on click à l'interieur
                    $('body').on('click', settings.mainContainer+' .popUpSearch , '+settings.mainContainer+' .popUpSearch *', function(e){
                        e.stopPropagation();
                    });

				}else{
					$(settings.mainContainer+' .popUpSearch').css('display', 'block');
				}
			}

			function positionButtonPopUp() {
		    	$(settings.mainContainer+' .popUpSearch').css('position','absolute');
                var posLeft = actPos.left + parseInt($(settings.activateAttr).css('marginLeft'));
                var postop = actPos.top + parseInt($(settings.activateAttr).css('marginTop'));

				switch(settings.popUpPositionButton) {
				    case "top":
					    positionHAlignPopUp();
				    	$(settings.mainContainer+' .popUpSearch').css('top',postop - $(settings.mainContainer+' .popUpSearch').outerHeight() -10);
				        break;
				    case "right":
					    positionVAlignPopUp();

				    	$(settings.mainContainer+' .popUpSearch').css('left',posLeft + $(settings.activateAttr).outerWidth() + 10);
				        break;
			        case "bottom":
					    positionHAlignPopUp();
				        $(settings.mainContainer+' .popUpSearch').css('top',postop + $(settings.activateAttr).outerHeight() + 10);
				        break;
			        case "left":
					    positionVAlignPopUp();
				    	$(settings.mainContainer+' .popUpSearch').css('left',posLeft - 250 -10);
				        break;
				    default:
				        console.log('+----------\n|searchPopUp_plugin error :\n+----------\n|-[popUpPositionButton] arg need to be "top","right","bottom" or "left" \n|-your arg : "'+settings.popUpPositionButton+'"\n+----------');
				}
			}


			function positionHAlignPopUp() {
				var posLeft = actPos.left + parseInt($(settings.activateAttr).css('marginLeft'));
				switch(settings.popUpPositionAlign) {
				    case "start":
				    	$(settings.mainContainer+' .popUpSearch').css('left',posLeft);
				        break;
				    case "center":
				    	$(settings.mainContainer+' .popUpSearch').css('left',posLeft -( ( 250/2 ) - ( $(settings.activateAttr).outerWidth() / 2 ) ) );
				        break;
			        case "end":
				    	$(settings.mainContainer+' .popUpSearch').css('left',posLeft - (250 - $(settings.activateAttr).outerWidth() ) );
				        break;
				    default:
				        console.log('+----------\n|searchPopUp_plugin error :\n+----------\n|-[popUpPositionAlign] arg need to be "start","center" or "end" \n|-your arg : "'+settings.popUpPositionAlign+'"\n+----------');
				}
			}

			function positionVAlignPopUp() {
                var postop = actPos.top + parseInt($(settings.activateAttr).css('marginTop'));
                switch(settings.popUpPositionAlign) {
				    case "start":
				    	$(settings.mainContainer+' .popUpSearch').css('top',postop);
				        break;
				    case "center":
				    	$(settings.mainContainer+' .popUpSearch').css('top',postop - ( (  $(settings.mainContainer+' .popUpSearch').outerHeight()/2 ) - ( $(settings.activateAttr).outerHeight() / 2 ) ) );
				        break;
			        case "end":
				    	$(settings.mainContainer+' .popUpSearch').css('top',postop - ( $(settings.mainContainer+' .popUpSearch').outerHeight() - $(settings.activateAttr).outerHeight()) );
				        break;
				    default:
				        console.log('+----------\n|searchPopUp_plugin error :\n+----------\n|-[popUpPositionAlign] arg need to be "start","center" or "end" \n|-your arg : "'+settings.popUpPositionAlign+'"\n+----------');
				}
			}

			function createBase(){
				if(settings.searchActive){
                    $(settings.mainContainer).append(''+
                        '<div class="popUpSearch">'+
                        	'<div class="popUpSearch-input-content">'+
                        		'<input type="text" name="search-team" placeholder="search..."/>'+
							'</div>'+
                        	'<div class="popUpSearch-itemsContainer"></div>'+
                        '</div>');
				}else{
                    $(settings.mainContainer).append(''+
                        '<div class="popUpSearch">'+
                        	'<div class="popUpSearch-itemsContainer"></div>'+
                        '</div>');
				}

			}

			function drawIcon($data){
				$.each($data, function(key, value) {
					appendItem(value);
				});
				animateApparition();
			}

			function appendItem($value){
				var itemHtml = '<div class="popUpSearch-item">'+
							'<div class="popUpSearch-item-content">'+
								'<div data-nom-team="'+$value.nom+'" data-id-spopup="'+escapeHtml($value.id)+'" class="popUpSearch-item-icon" style="background: transparent url(\''+escapeHtml($value.img)+'\')no-repeat 50% 50% / contain;"></div>'+
							'</div>'+
						'</div>';
				$(settings.mainContainer+' .popUpSearch  .popUpSearch-itemsContainer').prepend(itemHtml);
			}

			function animateApparition(){
				var delays = 0;
				$(settings.mainContainer+' .popUpSearch  .popUpSearch-itemsContainer .popUpSearch-item').each(function(){
					$(this).find('.popUpSearch-item-content').delay(delays).queue(function(next) {
						$(this).addClass("animate");
						next();
					});
					delays += 40;
				});
			}

			function bubbleName(){
				$(''+
					'<div class="popUpSearch-nameBubble">'+
						'<span></span>'+
					'</div>').insertAfter('.popUpSearch');
				bubbleMove();
			}
			function bubbleMove(){
				$('body').on('mousemove', settings.mainContainer+' .popUpSearch  .popUpSearch-itemsContainer .popUpSearch-item', function(event){
					$this = $(this);
					$('.popUpSearch-nameBubble span').text($this.find('.popUpSearch-item-icon').attr("data-nom-team"));
					$('.popUpSearch-nameBubble').addClass('show');
					var posX  = event.pageX - $('.popUpSearch-nameBubble').width()/2;
					$('.popUpSearch-nameBubble').css('top', event.pageY-60);
					$('.popUpSearch-nameBubble').css('left', posX);
				});

				$('body').on('mouseleave', settings.mainContainer+' .popUpSearch  .popUpSearch-itemsContainer', function(){
					$this = $(this);
					$('.popUpSearch-nameBubble span').text("");
					$('.popUpSearch-nameBubble').removeClass('show');
				});
			}

			function removeContent(){
				$(settings.mainContainer+' .popUpSearch  .popUpSearch-itemsContainer').html("");
			}

			function search(){

				//on keyup, start the countdown
                $('body').on('keyup',settings.mainContainer+' .popUpSearch .popUpSearch-input-content input[name="search-team"]', function () {
                    $this = $(this);
                    clearTimeout(typingTimer);
                    typingTimer = setTimeout(function () {
                        doneTyping($this);
                    }, 100);
                });

				//on keydown, clear the countdown
                $('body').on('keydown',settings.mainContainer+' .popUpSearch .popUpSearch-input-content input[name="search-team"]',function () {
                    clearTimeout(typingTimer);
                });

				//user is "finished typing," do something
                function doneTyping ($this) {
                    var valeur = $this.val();

                    removeContent();
                    if(valeur.length > 0 ){

                        $.ajax({
                            method: 'POST',
                            url: url2,
                            data: {nom_club: valeur, _token: token},
                            success: function (msg) {
                                drawIcon(msg.data);
                            }
                        });

                    }else{
                        removeContent();
                    }
                    if(settings.popUpPositionButton != "bottom" && settings.needActivate){
                        positionButtonPopUp();
                    }
                }
			}
		});

    };
	
}( jQuery ));