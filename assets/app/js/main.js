/*
 * Project:    Dynasty - Responsive Coming Soon Template
 * Version:    1.4
 * Autor:      -SitoWeb-
 * http://themeforest.net/user/-SitoWeb-
 *
 */

(function($) {
    "use strict";

    var INVALID_EMAIL_ERROR_MESSAGE = "Please enter a valid email address.",
            INVALID_NAME_ERROR_MESSAGE = "Please enter your name.",
            SUBSCRIBE_SUCCESS_MESSAGE = "You've been successfully added to our mailing lists. Thanks!",
            SERVER_ERROR_MESSAGE = "Message not sent!",
            CONTACT_SUCCESS_MESSAGE = "Message sent. Thanks!", sliderObject;

    function hideLoderPage() {
        var preloader = document.getElementById('preloader'),
                path = Snap(preloader.querySelector('svg')).select('path');

        $(".logo-loading").fadeOut(100);
        path.animate({
            path: 'M 0,0 0,60 80,60 80,0 Z M 80,0 80,60 0,60 0,0 Z'
        }, 600, mina.bounce, function() {
            classie.removeClass(preloader, 'show');
        });
    }

   
    function resizeWrapper() {
        var activInfoBox = $('.info-box.active-page'),
                position = activInfoBox.position(),
                height = activInfoBox.outerHeight();

        // $('#wrapper').height(position.top + height);


    }

    function onClosePage() {
        var activePage = document.getElementsByClassName('active-page');
        for (var i = activePage.length - 1; i >= 0; i--)
            classie.removeClass(activePage[i], 'active-page');

        var homePage = document.getElementById('home-page');
        classie.addClass(homePage, 'active-page');
    }

    function showAlert(alertId, alertClassName, message) {
        $("#" + alertId).find(".alert-text").text(message);
        $("#" + alertId).attr("class", "alert active-alert " + alertClassName);
        setTimeout(function() {
            $("#" + alertId).attr("class", "alert");
        }, 10000);
    }
    function hideAlert(alertId) {
        $("#" + alertId).stop().attr("class", "alert");
    }

    // email validation
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }

    // subscrise form validation and send
    function submitSubscribeForm() {
        var alertId = "subscribe-alert",
                alertSuccessClassName = "alert-success",
                alertWarningClassName = "alert-warning";

        hideAlert(alertId); // hide old messages

        var emailValue = document.getElementById("subscribe-email-field").value;
        if (validateEmail(emailValue)) {
            // send email value to server
            var request = $.ajax({
                type: "POST",
                url: "php/send-subscribe.php",
                async: false,
                data: {
                    email: emailValue
                }
            });

            // show respons
            request.done(function(responseText) {
                if (responseText === "true") {
                    showAlert(alertId, alertSuccessClassName, SUBSCRIBE_SUCCESS_MESSAGE);
                } else {
                    showAlert(alertId, alertWarningClassName, SERVER_ERROR_MESSAGE);
                }
            });
            request.fail(function() {
                showAlert(alertId, alertWarningClassName, SERVER_ERROR_MESSAGE);
            });
        } else {
            showAlert(alertId, alertWarningClassName, INVALID_EMAIL_ERROR_MESSAGE);
        }
        return false;
    }

    // contact form validation and send
    function submitContactForm() {
        var alertId = "normal-loginn",
                alertSuccessClassName = "alert-success",
                alertWarningClassName = "alert-warning";
        // hide old messages
        hideAlert(alertId);

        var nameValue = document.getElementById('contact-name').value;
        var emailValue = document.getElementById('contact-email').value;
        var messageValue = document.getElementById('contact-message').value;
        if (nameValue !== "" && validateEmail(emailValue)) {
            // send form values to server
            var request = $.ajax({
                type: "POST",
                url: 'php/send-message.php',
                async: false,
                data: {
                    name: nameValue,
                    email: emailValue,
                    message: messageValue
                }
            });

            // show respons
            request.done(function(responseText) {
                if (responseText === "true") {
                    showAlert(alertId, alertSuccessClassName, CONTACT_SUCCESS_MESSAGE);
                } else {
                    showAlert(alertId, alertWarningClassName, SERVER_ERROR_MESSAGE);
                }
            });
            request.fail(function() {
                showAlert(alertId, alertWarningClassName, SERVER_ERROR_MESSAGE);
            });
        } else {
            if (nameValue === "") {
                showAlert(alertId, alertWarningClassName, INVALID_NAME_ERROR_MESSAGE);
            } else {
                showAlert(alertId, alertWarningClassName, INVALID_EMAIL_ERROR_MESSAGE);
            }
        }
        return false;
    }

    // from http://stackoverflow.com/a/11381730/989439
    function mobilecheck() {
        var check = false;
        (function(a) {
            if (/(android|ipad|playbook|silk|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))
                check = true;
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    }

    function init() {
        if (!(/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) && $("#bg-video").length > 0) {
            $("#bg-video").mb_YTPlayer();
        }

        $("#info-box-close-button").click(onClosePage);
        $("#subscribe-form").submit(submitSubscribeForm);
        $("#contact-form").submit(submitContactForm);

        if (mobilecheck()) {
            var body = document.getElementsByTagName('body')[0];
            classie.addClass(body, 'is-mobile');
        }

        if ($('#maximage').length > 0)
            sliderObject = $('#maximage').maximage({
                fillElement: '#perspective'
            });
		return true;
    }
	
	function onNewsletterButton() {
        var propertyString = 'newsletters-page';
		
        var activePage = document.getElementsByClassName('active-page');
        for (var i = activePage.length - 1; i >= 0; i--)
			classie.removeClass(activePage[i], 'active-page');

			var page = document.getElementById(propertyString);
			classie.addClass(page, 'active-page');

			if (propertyString !== 'home-page') {
				var closeButton = document.getElementById('info-box-close-button');
                classie.addClass(closeButton, 'active-page');
			}
    }
	
    $(window).ready(function() {
        init();
        resizeWrapper();
		$("#newsletter-bage-button").click(onNewsletterButton);
        hideLoderPage();
		
		var countrySelector = $('input[name="kimlik_cepno"]');
		countrySelector.intlTelInput({
			initialCountry: "tr",
			nationalMode: false,
			geoIpLookup: function(callback) {
				$.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
					var countryCode = (resp && resp.country) ? resp.country : "";
					callback(countryCode);
				});
			},
			utilsScript: "/assets/app/js/utils.js"
		});

		countrySelector.on("countrychange", function(e, countryData) {
		  var countryData = countrySelector.intlTelInput("getSelectedCountryData");
		  $('#sms-login-form input[name="country"]').val(countryData.iso2);
		  $('#sms-login-form input[name="dialcode"]').val(countryData.dialCode);
		  // $('input[name="kimlik_cepno"]').val('+' + countryData.dialCode);
		}).trigger("countrychange");
		
		function reset() {
			$('.number-msg-valid').hide();
			$('.number-msg-error').hide();
		}
		
		function fillSmsData() {
			$('#sms-login-form input[name="number_is_valid"]').val(countrySelector.intlTelInput("isValidNumber"));
			$('#sms-login-form input[name="intl_number"]').val(countrySelector.intlTelInput("getNumber"));
		}
		
		countrySelector.on('blur keyup change countrychange', function() {
			reset();
			if ($.trim(countrySelector.val())) {
				if (countrySelector.intlTelInput("isValidNumber")) {
				  $('.number-msg-valid').show();
				} else {
				  $('.number-msg-error').show();
				}
				fillSmsData();
			}
		});

		$("#sms-login-form").submit(function(e) {
			if ($.trim(countrySelector.val()) == '') {
				return false;
			}
			if (!countrySelector.intlTelInput("isValidNumber")){
				return false;
			}
			fillSmsData();
		});
				
		
		$(window).resize(function() {
			resizeWrapper();
						
				// console.log(123);
				// block = $('.video img');
				// h = $('.video img').parent().height();
				// $('.video img').each(function(e,l){
				// hh = l.height;
				
				// $(l).css('top',(h-hh)/2);
				// console.log($(l));
				// });

		});
		$(window).resize();
	});
})(jQuery);

function soonCompleteCallback(){
	jQuery('#normal-login .sms-soon-counter').hide();
	jQuery('#normal-login .try-again-sms').show();
	jQuery('#login-signup a.sign-sms').attr('data-property', "{pageId:'sms-login'}");
}