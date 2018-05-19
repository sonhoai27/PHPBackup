$(document).ready(function () {
    //admin
    $("#scms_filter_brand").change(function () {
        var value_brand = $("#scms_filter_brand").find("option:selected").val()
        var cur_url = window.location.href
        var check = cur_url.substring(cur_url.lastIndexOf("/") + 1, cur_url.lastIndexOf("/") + 4)
        if(check != "xem" && check != "mul"){
            window.location = cur_url.substring(0, cur_url.indexOf("product-list")) + "product-list/" + "hang-"+value_brand
        }else {
            if(check == "xem"){
                var xem = cur_url.substring(cur_url.indexOf("xem-") + 4)
                window.location = cur_url.substring(0, cur_url.indexOf("product-list")) + "product-list/" + "mul-"+value_brand+ "-" + xem
            }else {
                if(check == "mul"){
                    var xem = cur_url.substring(cur_url.lastIndexOf("-"))
                    window.location = cur_url.substring(0, cur_url.indexOf("product-list")) + "product-list/" + "mul-"+value_brand + xem
                }
            }
        }
    })
    $("#scms_filter_choose").change(function () {
        var value_filter_choose = $("#scms_filter_choose").find("option:selected").val()
        var cur_url = window.location.href
        var check = cur_url.substring(cur_url.lastIndexOf("/") + 1, cur_url.lastIndexOf("/") + 5)
        if(check != "hang" && check != "mul-"){
            window.location = cur_url.substring(0, cur_url.indexOf("product-list")) + "product-list/" + "xem-"+value_filter_choose
        }else {
            if(check == "hang"){
                var xem = cur_url.substring(cur_url.indexOf("hang-") + 5)
                window.location = cur_url.substring(0, cur_url.indexOf("product-list")) + "product-list/" + "mul-"+ xem + "-" + value_filter_choose
            }else {
                if(check == "mul-"){
                    var xem = cur_url.substring(cur_url.indexOf("mul-") + 4, cur_url.lastIndexOf("-"))
                    window.location = cur_url.substring(0, cur_url.indexOf("product-list")) + "product-list/" + "mul-"+xem + "-"+ value_filter_choose
                }
            }
        }
    })
})

//xu ly xoa
var array_id = []

function DeleteProductId(id) {
    var text_id = "";
    if (document.getElementById('prd_' + id).checked == true) {
        array_id.push(id)
        for (var i = 0; i < array_id.length; i++) {
            text_id = text_id + array_id[i] + ","
        }
    } else {
        if (document.getElementById('prd_' + id).checked == false) {
            for (var i = 0; i < array_id.length; i++) {
                if (array_id[i] == id) {
                    for (var j = i; j < array_id.length; j++) {
                        array_id[j] = array_id[j + 1]
                    }
                }
            }
            text_id = "";
            array_id.length--;
            for (var i = 0; i < array_id.length; i++) {
                text_id = text_id + array_id[i] + ","
            }
        }
    }
    // console.log(text_id.substr(0, (text_id.length - 1)))
    document.getElementById('listIdPrds').value = text_id.substr(0, (text_id.length - 1))
}