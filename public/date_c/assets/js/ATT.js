var date_diff_indays = function (date1, date2) {
    dt1 = new Date(date1);
    dt2 = new Date(date2);
    return Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate())) / (1000 * 60 * 60 * 24));
}
var curday = function (sp) {
    today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1;  
    var yyyy = today.getFullYear();

    if (dd < 10) dd = '0' + dd;
    if (mm < 10) mm = '0' + mm;
    return (yyyy + sp + mm + sp + dd);
};

 
function chageDate(d) {
    var today = new Date(d);
    var dd = today.getDate();
    var mm = today.getMonth() + 1;  

    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd;
    }
    if (mm < 10) {
        mm = '0' + mm;
    }
    var today = yyyy + '-' + mm + '-' + dd;
    return today;
}
function dtdC(id, g = "") {

    if (id == "Int") {
        $('.dtdR').on('click', dtdC);
        $(".dtdD").hide()
        $(".jalaali-date-input").show();
        $(".jalaali").prop('checked', true);
        return;
    }

    if (g == "") {
        id = $(this).attr("name");
        g = $("#" + this.id).val();
    }

    $("#" + id + "J").hide()
    $("#" + id + "Q").hide()
    $("#" + id + "G").hide()
    $("#" + id + g).show();

}
function dtdDrp() {


    $(".dtdD").attr("autocomplete", "off");
    dtdC('Int');

    $(".jalaali-date-input").jalaaliDatePicker({
        locale: "fa",
        format: "DD-MM-YYYY",
        jalaaliFormat: "jYYYY-jMM-jDD",
        dayViewHeaderFormat: "MMMM YYYY",
        jalaaljDayViewHeaderFormat: "jMMMM jYYYY",
        showSwitcher: false,
        allowInputToggle: false,
        showTodayButton: false,
        useCurrent: false,
        viewMode: 'days',
        isRTL: true,
        keepOpen: false,
        jalaali: true,
        debug: false,
        showClear: true,
        showTodayButton: true,
        showClose: true
    });

    $(".hijri-date-input").hijriDatePicker({
        locale: "ar-sa",
        format: "DD-MM-YYYY",
        hijriFormat: "iYYYY-iMM-iDD",
        dayViewHeaderFormat: "MMMM YYYY",
        hijriDayViewHeaderFormat: "iMMMM iYYYY",
        showSwitcher: false,
        allowInputToggle: false,
        showTodayButton: false,
        useCurrent: false,
        viewMode: 'days',
        isRTL: true,
        keepOpen: false,
        hijri: true,
        debug: false,
        showClear: true,
        showTodayButton: true,
        showClose: true
    });

    $(".m-date-input").hijriDatePicker({
        locale: "en",
        format: "YYYY-MM-DD",
        jalaaliFormat: "YYYY-MM-DD",
        dayViewHeaderFormat: "MMMM YYYY",
        jalaaljDayViewHeaderFormat: "MMMM YYYY",
        showSwitcher: false,
        showTodayButton: false,
        useCurrent: false,
        viewMode: 'days',
        isRTL: false,
        keepOpen: false,
        hijri: false,
        debug: false,
        showClear: true,
        showTodayButton: true,
        showClose: true
    });

    $(".hijri-date-input").on('dp.change', function (arg) {
        changeDate($(this).attr("aria-describedby"), arg, "Q")
    });

    $(".m-date-input").on('dp.change', function (arg) {
        changeDate($(this).attr("aria-describedby"), arg, "G")
    });

    $(".jalaali-date-input").on('jp.hide', function (arg) {
        changeDate($(this).attr("aria-describedby"), arg, "J")
    });
 
}
function RadioValue() {
    var id = "";
    $('.dtdM').each(function () {
        id = this.id
        $("#" + id + " input[type=radio]").each(function () {
            if ($(this).is(':checked')) {
                dtdC(id, $(this).val());
            }
        });
    });

}
function RadioValueReturn(ids) {
    var id = "J";
    $('#' + ids).each(function () {
        $("#" + this.id + " input[type=radio]").each(function () {
            if ($(this).is(':checked')) {
                id = $(this).val();
            }
        });
    });
    return id;
}
function changeDate(iy, arg, g) {


    if (!arg.date) {
        $("#" + iy + "Q").val('');
        $("#" + iy + "G").val('');
        $("#" + iy + "J").val('');
        console.log(arg.date);
        return;
    };

    let date = arg.date;
    const d = new Date(date.format("YYYY-MM-DD"))

    if (g == "Q") {

        $("#" + iy + "G").val(date.format("YYYY-MM-DD"));
        $("#" + iy + "J").val(chageDate(new Intl.DateTimeFormat('fa-IR-u-nu-latn').format(d)));
 
    }
    if (g == "J") {

        $("#" + iy + "G").val(date.format("YYYY-MM-DD"));

        let options = { year: 'numeric', month: 'numeric', day: 'numeric' };
        let format = new Intl.DateTimeFormat('ar-SA-u-nu-latn').format(d);
        format = new Intl.DateTimeFormat('en-SA-u-ca-islamic-umalqura', options);

        $("#" + iy + "Q").val(chageDate(format.format(date).replace(' AH', '')));
    }
    else {
        $("#" + iy + "J").val(chageDate(new Intl.DateTimeFormat('fa-IR-u-nu-latn').format(d)));

        let options = { year: 'numeric', month: 'numeric', day: 'numeric' };
        let format = new Intl.DateTimeFormat('ar-SA-u-nu-latn').format(d);
        format = new Intl.DateTimeFormat('en-SA-u-ca-islamic-umalqura', options);

        $("#" + iy + "Q").val(chageDate(format.format(date).replace(' AH', '')));
    }

    if (contains($("#" + iy + g).attr("class"), "onchange")) {
        ifFnExistsCallIt('onchange_' + $("#" + iy + g).attr("aria-describedby"));
    }
   
}

 