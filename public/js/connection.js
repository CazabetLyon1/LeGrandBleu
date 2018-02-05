$('document').ready(function(){

	initAll();

	function initAll(){
		fullpageInitPlug();
		loginRegisterSwitch();

	}

	/*******************************************
	* fullpage plugin
	*******************************************/

	function fullpageInitPlug(){

		$('#container').fullpage({
            //Navigation
            lockAnchors: true,
            navigation: true,
            navigationPosition: 'right',
            anchors:['monmon', 'mymymy'],

            showActiveTooltip: true,
            slidesNavigation: false,
            slidesNavPosition: 'bottom',

            //Scrolling
            css3: true,
            scrollingSpeed: 600,
            autoScrolling: true,
            fitToSection: true,
            fitToSectionDelay: 1000,
            scrollBar: false,
            easing: 'easeInOutCubic',
            easingcss3: 'cubic-bezier(1,.17,.47,1.2)',
            loopBottom: false,
            loopTop: false,
            loopHorizontal: false,
            continuousVertical: false,
            continuousHorizontal: false,
            scrollHorizontally: false,
            interlockedSlides: false,
            dragAndMove: false,
            offsetSections: false,
            resetSliders: false,
            fadingEffect: false,
            scrollOverflow: false,
            scrollOverflowReset: false,
            scrollOverflowOptions: null,
            touchSensitivity: 15,
            normalScrollElementTouchThreshold: 5,
            bigSectionsDestination: null,

            //Accessibility
            keyboardScrolling: true,
            animateAnchor: true,
            recordHistory: true,

            //Design
            controlArrows: true,
            verticalCentered: true,
            responsiveWidth: 0,
            responsiveHeight: 0,
            responsiveSlides: false,
            parallax: false,
            parallaxOptions: {type: 'reveal', percentage: 62, property: 'translate'},

            //Custom selectors
            sectionSelector: '.section',
            slideSelector: '.slide',

            lazyLoading: true,
            afterLoad: function(anchorLink, index){
                //using index
                if(index == 1){
                    $('#nav').css('display','none');
                    $('#nav').css('opacity', 0);
                }
            },
            onLeave: function(index, nextIndex, direction){
                if(index == 1){
                    $('#nav').css('display', 'block');
                    setTimeout(function () {
                        $('#nav').css('opacity', 1);
                    },100);
                }
                if(nextIndex == 1){
                	$('#nav').css('opacity', 0);
                }
            }


        });
	}
	function loginRegisterSwitch(){
		$('#login_cards_container .connect_cards_header').click(function(){
			$this = $(this);
			if(!$this.parent().hasClass('active')){
				$this.parent().addClass('active');
				$('#register_cards_container').removeClass('active');
			}
		});

		$('#register_cards_container .connect_cards_header').click(function(){
			$this = $(this);
			if(!$this.parent().hasClass('active')){
				$this.parent().addClass('active');
				$('#login_cards_container').removeClass('active');
			}
		});
	}


});