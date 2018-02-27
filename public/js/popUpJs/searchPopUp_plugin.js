
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

            initAll();

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

			function directAffiche(){
                $('body').on('click', ''+settings.mainContainer+' '+settings.activateAttr, function () {
                    removeContent();
                    $.ajax({
						method: 'POST',
						url: settings.dataUrl,
						data: {_token: token},
						success: function (msg) {
							console.log(msg.data);
							drawIcon(msg.data);
						}
					});
                });

			}

			function needActivation(){
				if(settings.needActivate){
					$('#popUpSearch').css('display', 'none');
					positionButtonPopUp();
					$('body').on('click', settings.activateAttr, function(){
						if(activationToggle){
							$('#popUpSearch').css('display', 'none');
							activationToggle = false;
						}else{
							$('#popUpSearch').css('display', 'block');
							activationToggle = true;
						}
					});
					
				}else{
					$('#popUpSearch').css('display', 'block');
				}
			}

			function positionButtonPopUp() {
		    	$('#popUpSearch').css('position','absolute');
                var posLeft = actPos.left + parseInt($(settings.activateAttr).css('marginLeft'));
                var postop = actPos.top + parseInt($(settings.activateAttr).css('marginTop'));

				switch(settings.popUpPositionButton) {
				    case "top":
					    positionHAlignPopUp();
				    	$('#popUpSearch').css('top',postop - $('#popUpSearch').outerHeight() -10);
				        break;
				    case "right":
					    positionVAlignPopUp();

				    	$('#popUpSearch').css('left',posLeft + $(settings.activateAttr).outerWidth() + 10);
				        break;
			        case "bottom":
					    positionHAlignPopUp();
				        $('#popUpSearch').css('top',postop + $(settings.activateAttr).outerHeight() + 10);
				        break;
			        case "left":
					    positionVAlignPopUp();
				    	$('#popUpSearch').css('left',posLeft - 250 -10);
				        break;
				    default:
				        console.log('+----------\n|searchPopUp_plugin error :\n+----------\n|-[popUpPositionButton] arg need to be "top","right","bottom" or "left" \n|-your arg : "'+settings.popUpPositionButton+'"\n+----------');
				}
			}


			function positionHAlignPopUp() {
				var posLeft = actPos.left + parseInt($(settings.activateAttr).css('marginLeft'));
				switch(settings.popUpPositionAlign) {
				    case "start":
				    	$('#popUpSearch').css('left',posLeft);
				        break;
				    case "center":
				    	$('#popUpSearch').css('left',posLeft -( ( 250/2 ) - ( $(settings.activateAttr).outerWidth() / 2 ) ) );
				        break;
			        case "end":
				    	$('#popUpSearch').css('left',posLeft - (250 - $(settings.activateAttr).outerWidth() ) );
				        break;
				    default:
				        console.log('+----------\n|searchPopUp_plugin error :\n+----------\n|-[popUpPositionAlign] arg need to be "start","center" or "end" \n|-your arg : "'+settings.popUpPositionAlign+'"\n+----------');
				}
			}

			function positionVAlignPopUp() {
                var postop = actPos.top + parseInt($(settings.activateAttr).css('marginTop'));
                switch(settings.popUpPositionAlign) {
				    case "start":
				    	$('#popUpSearch').css('top',postop);
				        break;
				    case "center":
				    	$('#popUpSearch').css('top',postop - ( (  $('#popUpSearch').outerHeight()/2 ) - ( $(settings.activateAttr).outerHeight() / 2 ) ) );
				        break;
			        case "end":
				    	$('#popUpSearch').css('top',postop - ( $('#popUpSearch').outerHeight() - $(settings.activateAttr).outerHeight()) );
				        break;
				    default:
				        console.log('+----------\n|searchPopUp_plugin error :\n+----------\n|-[popUpPositionAlign] arg need to be "start","center" or "end" \n|-your arg : "'+settings.popUpPositionAlign+'"\n+----------');
				}
			}

			function createBase(){
				if(settings.searchActive){
                    $(settings.mainContainer).append(''+
                        '<div id="popUpSearch">'+
                        	'<div id="popUpSearch-input-content">'+
                        		'<input type="text" name="search-team" placeholder="search..."/>'+
							'</div>'+
                        	'<div id="popUpSearch-itemsContainer"></div>'+
                        '</div>');
				}else{
                    $(settings.mainContainer).append(''+
                        '<div id="popUpSearch">'+
                        	'<div id="popUpSearch-itemsContainer"></div>'+
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
								'<div data-nom-team="'+$value.nom+'" class="popUpSearch-item-icon" style="background: transparent url(\''+$value.img+'\')no-repeat 50% 50% / contain;"></div>'+
							'</div>'+
						'</div>';
				$('#popUpSearch  #popUpSearch-itemsContainer').prepend(itemHtml);
			}

			function animateApparition(){
				var delays = 0;
				$('#popUpSearch  #popUpSearch-itemsContainer .popUpSearch-item').each(function(){
					$(this).find('.popUpSearch-item-content').delay(delays).queue(function(next) {
						$(this).addClass("animate");
						next();
					});
					delays += 40;
				});
			}

			function bubbleName(){
				$(''+
					'<div id="popUpSearch-nameBubble">'+
						'<span></span>'+
					'</div>').insertAfter('#popUpSearch');
				bubbleMove();
			}
			function bubbleMove(){
				$('body').on('mousemove', '#popUpSearch  #popUpSearch-itemsContainer .popUpSearch-item', function(event){
					$this = $(this);
					$('#popUpSearch-nameBubble span').text($this.find('.popUpSearch-item-icon').attr("data-nom-team"));
					$('#popUpSearch-nameBubble').addClass('show');
					var posX  = event.pageX - $('#popUpSearch-nameBubble').width()/2;
					$('#popUpSearch-nameBubble').css('top', event.pageY-60);
					$('#popUpSearch-nameBubble').css('left', posX);
				});

				$('body').on('mouseleave', '#popUpSearch  #popUpSearch-itemsContainer', function(){
					$this = $(this);
					$('#popUpSearch-nameBubble span').text("");
					$('#popUpSearch-nameBubble').removeClass('show');
				});
			}

			function removeContent(){
				$('#popUpSearch  #popUpSearch-itemsContainer').html("");
			}

			function search(){
				$('body').on('input','#popUpSearch #popUpSearch-input-content input[name="search-team"]',function(e){
					$this = $(this);

					var valeur = $this.val();
					removeContent();
					if(valeur.length > 0 ){

						drawIcon(data);

					}else{

						removeContent();
					}
					if(settings.popUpPositionButton != "bottom" && settings.needActivate){
						positionButtonPopUp();
					}
				});
			}
		});

    };
	
}( jQuery ));