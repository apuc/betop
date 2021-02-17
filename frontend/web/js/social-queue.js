// ajax to get service data for selected social
//global for price of selected service
var price = 0;
var is_answer = false;

$(document).ready(async function ($) {
    let id_soc = $('#socialqueueform-social').val();
    let type_id = $('#socialqueueform-type_id').val();
    if (id_soc != "") {
        ajaxChangeData($, false);
        if (type_id != "") {
            $("#socialqueueform-type_id").val(type_id);
            enableDisableFields($);
        }
    }
});

function disableHideFields() {
    $('#div_age').css('display', 'none');
    $('#div_answer').css('display', 'none');
    $('#div_friends').css('display', 'none');
    $('#div_link').css('display', 'none');
    $('#socialqueueform-link').val(null);
    $('#div_msg').css('display', 'none');
    $('#socialqueueform-msg').val(null);
    $('#div_gender').css('display', 'none');
}

function ajaxChangeData($, sync=true)
{
    let url = window.location.origin + '/cabinet/social-queue/create-get-services';
    let csrf = $('meta[name=csrf-token]').attr("content");
    let id_soc = $('#socialqueueform-social').val();
    $('#socialqueueform-type_id').empty();
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            id_soc: id_soc,
            _csrf : csrf
        },
        success: function (data) {
            if (data.code == 200) {
                $.each(data['data'],
                    function (item, index) {
                        let newOption = new Option(index, item, false, false);
                        $('#socialqueueform-type_id').append(newOption);
                    }
                );
                $("#socialqueueform-type_id")[0].selectedIndex = 0;
                enableDisableFields($);
                if (data['data'].length == 0) {
                    disableHideFields();
                    $('#success_button').attr('disabled', 'disabled');
                    $('#div_balance').css('display', 'none');
                    $('#div_price').css('display', 'none');
                }
            }
        },
        async: sync
    });
}

// enable\disable fields depending on what fields are needed. mb test
function enableDisableFields($)
{
    let url = window.location.origin + '/cabinet/social-queue/create-get-fields';
    let csrf = $('meta[name=csrf-token]').attr("content");
    let type_id = $('#socialqueueform-type_id').val();
    $.ajax({
        url: url,
        type: 'POST',
        data: {
            type_id: type_id,
            _csrf : csrf
        },
        success: function (data) {
            if (data.code == 200) {
                let inputs = data.inputs;
                price = data.price;
                disableHideFields();
                $.each(inputs,
                    function (item, index) {
                        $('#div_' + index).css('display', 'block');
                    });
                $('.required-label').css('display', 'block');
                $('.required-fields').css('display', 'block');
                $('.non-required-fields').css('display', 'block');
                $('.non-required-label').css('display', 'block');
                if (inputs.length === 1) {
                    $('.non-required-fields').css('display', 'none');
                    $('.non-required-label').css('display', 'none');
                } else {

                }
                $('#div_balance').css('display', 'block');

                is_answer = inputs.includes('answer');
                $('#div_price').css('display', 'block');
                calculatePrice($);
            }
        }
    });
}

function calculatePrice($)
{
    let index = $('#socialqueueform-friends_id')[0].selectedIndex - 1;
    let count = $('#socialqueueform-balance').val();
    let current_price = Math.round((price * friend_prices[index] * count + Number.EPSILON) * exponent) / exponent;
    $('#price_text').text('Стоимость услуги - ' + current_price + '$');
    $('#socialqueueform-price').val(current_price * exponent);
    if (balance_cash >= Math.round(current_price * exponent)) {
        $('#success_button').removeAttr('disabled');
        $('#errors').css('display', 'none');
    } else {
        $('#success_button').attr('disabled', 'disabled');
        $('#errors').text("Недостаточно средств на балансе для создания задачи");
        $('#errors').css('display', 'block');
    }
}

$('#socialqueueform-link').blur(function () {
    if (is_answer) {
        $('#div_answer').css('display', 'none');
        $('#socialqueueform-answer_id').empty();
        let url = window.location.origin + '/cabinet/social-queue/create-get-answers';
        let link = $('#socialqueueform-link').val();
        let csrf = $('meta[name=csrf-token]').attr("content");
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                link: link,
                _csrf : csrf
            },
            success: function (data) {
                if (data.code == 200) {
                    $.each(data.answers,
                        function (item, index) {
                            let newOption = new Option(index, item, false, false);
                            $('#socialqueueform-answer_id').append(newOption);
                        });
                    $('#poll_text').text('Вопрос - ' + data.title);
                    $('#div_answer').css('display', 'block');
                    $("#socialqueueform-answer_id")[0].selectedIndex = 0;
                    $("#socialqueueform-answer_id").trigger('change');
                }
            }
        });
    }
});

$('#socialqueueform-balance').blur(function () {
    calculatePrice($);
});

$('#socialqueueform-balance').change(function () {
    calculatePrice($);
});