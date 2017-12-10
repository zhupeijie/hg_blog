function formatLabel (label) {

    return "<div class='select2-result-repository clearfix'>" +

    "<div class='select2-result-repository__meta'>" +

    "<div class='select2-result-repository__title'>" +

    label.name ? label.name : "Laravel"   +

        "</div></div></div>";

}


function formatLabelSelection (label) {

    return label.name || label.text;

}


$(".js-example-placeholder-multiple").select2({

    tags: true,

    placeholder: ' 请选择标签',

    // minimumInputLength: 1,

    language: "zh-CN",         //中文

    ajax: {

        url: api_get_label_like,

        dataType: 'json',

        delay: 250,

        data: function (params) {

            return {

                q: params.term

            };

        },

        processResults: function (data, params) {

            return {

                results: data

            };

        },

        cache: true

    },

    templateResult: formatLabel,

    templateSelection: formatLabelSelection,

    escapeMarkup: function (markup) { return markup; }

});