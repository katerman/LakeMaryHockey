var percentColors = [
    { pct: 0.0, color: { r: 0xff, g: 0x00, b: 0 } },
    { pct: 0.5, color: { r: 0xff, g: 0xff, b: 0 } },
    { pct: 1.0, color: { r: 0x00, g: 0xff, b: 0 } } ];

var getColorForPercentage = function (pct) {
        for (var i = 0; i < percentColors.length; i++) {
            if (pct <= percentColors[i].pct) {
                var lower = percentColors[i - 1] || {
                    pct: 0.1,
                    color: {
                        r: 0x0,
                        g: 0x00,
                        b: 0
                    }
                };
                var upper = percentColors[i];
                var range = upper.pct - lower.pct;
                var rangePct = (pct - lower.pct) / range;
                var pctLower = 1 - rangePct;
                var pctUpper = rangePct;
                var color = {
                    r: Math.floor(lower.color.r * pctLower + upper.color.r * pctUpper),
                    g: Math.floor(lower.color.g * pctLower + upper.color.g * pctUpper),
                    b: Math.floor(lower.color.b * pctLower + upper.color.b * pctUpper)
                };
                return 'rgb(' + [color.r, color.g, color.b].join(',') + ')';
            }
        }
    }

$(document).ready(function ($) {
    // set the first colors
    $('div.polls').find('span.option').each(function () {
        $(this).css({
            backgroundColor: getColorForPercentage($(this).attr('title') / 100)
        });
    });
    // the on click event
    $("div.polls > form > p").click(function () {
        var loader = $('<img src="lib/loading.gif" />');

        var poll = $(this).parents("div.polls");
        var form = $(this).parents("form");

        var poll_id = poll.attr("id");

        if (form.hasClass("closed")) {
            return false;
        }
        var option_id = $(this).find('input').val();

        $(":radio", form).hide();
        $("em", $(this)).html(loader).show();
        form.addClass("closed");
        //send the poll id and the selected option id    
        $.post('vote.php', {
            poll: poll_id,
            option: option_id
        }, function (data) {

            $("img", form).remove();
            //set the new options Percentages
            $.each(data.results, function (option, value) {
                $("p#option_" + option).find("span").show().css({
                    width: 0,
                    opacity: 0
                }).animate({
                    width: value + "%",
                    backgroundColor: getColorForPercentage(value / 100),
                    opacity: 1
                }, "slow", "swing", function () {
                    $("p#option_" + option).find("em").text(value + "%").fadeIn("slow");
                })
            });

        }, "json");
        return false;
    });
});