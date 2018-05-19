// var BASE_URL = "https://admin.dqwatch.com"
var BASE_URL = "http://localhost:8082/my-MVC"
    //xu ly xoa
    // var array_id = []
    //
    // function DeleteProductId(id) {
    //     var text_id = "";
    //     if (document.getElementById('prd_' + id).checked == true) {
    //         array_id.push(id)
    //         for (var i = 0; i < array_id.length; i++) {
    //             text_id = text_id + array_id[i] + ","
    //         }
    //     } else {
    //         if (document.getElementById('prd_' + id).checked == false) {
    //             for (var i = 0; i < array_id.length; i++) {
    //                 if (array_id[i] == id) {
    //                     for (var j = i; j < array_id.length; j++) {
    //                         array_id[j] = array_id[j + 1]
    //                     }
    //                 }
    //             }
    //             text_id = "";
    //             array_id.length--;
    //             for (var i = 0; i < array_id.length; i++) {
    //                 text_id = text_id + array_id[i] + ","
    //             }
    //         }
    //     }
    //     // console.log(text_id.substr(0, (text_id.length - 1)))
    //     document.getElementById('listIdPrds').value = text_id.substr(0, (text_id.length - 1))
    // }

$(document).ready(function() {
    //menu
    var STATUS_STATE_MENU = false
    $(".btnPrimaryMenu").click(function() {
        if (!STATUS_STATE_MENU) {
            $(".sh_menu_left").hide()
            STATUS_STATE_MENU = true
            $(".primary_content").removeClass("col-sm-10")
            $(".primary_content").css("margin-left", "0")
            $(".primary_content").addClass("col-sm-12")
        } else {
            $(".sh_menu_left").show()
            STATUS_STATE_MENU = false
            $(".primary_content").removeClass("col-sm-12")
            $(".primary_content").css("margin-left", "16.6667%")
            $(".primary_content").addClass("col-sm-10")
        }
    })

    $(".normal-tab li").click(function(e) {
        var position = $(this).index() + 1
        $(".normal-tab").each(function() {
            $(".normal-tab").find("li.active").removeClass("active")
        })
        $(this).addClass("active")
        $(".content-tab").each(function() {
            $(this).find(".child-tab.active").removeClass("active")
        })
        var selectContentTab = ".content-tab .child-tab:nth-child(" + (position) + ")"
        $(selectContentTab).addClass("active")
    })

    $("#input-sale-off-prd").keyup(function() {
        var price_prd = $("#input-price-prd").val()
        $(".title_noty_sale").html(
            (price_prd - (($(this).val() * price_prd) / 100)) + " đ"
        )
    })

    $(".input_file").change(function() {
        var names = [];
        for (var i = 0; i < $(this).get(0).files.length; ++i) {
            names.push($(this).get(0).files[i].name);
        }
        var result = "";
        for (var i = 0; i < names.length; i++) {
            result += "<p>" + names[i] + "</p>"
        }

        $(".content_file_name_upload").html(result)
    })


	



    $(".add_img").click(function() {
        var id_prd = $(".add_img span").text()
        var content_add_new_img = `<li class="action">
            <input type="file" name="input_img_edit" id="input-img-edit">
            <img src="./public/images/cdn/icon/no-image.svg" alt="" data-img="2-` + id_prd + `">
            <div class="the_img_upload_action">
                <span class="add_new_img">Thêm mới</span>
            </div>
            <div class="loading-upload"><div class="progress"></div></div>
         </li>`

        if ($(".scms_img_upload .action").length < 5) {
            $(this).parent().before(content_add_new_img)
        }
    })

    $(document).on('click', '.edit_img', function(e) {
        var file_data = $(this).parent().parent().find("#input-img-edit").prop("files")[0]
        var id_img = $(this).parent().parent().find("img").attr("data-img")
        var form_data = new FormData()
        form_data.append("file", file_data)
        form_data.append("id_file", id_img)
        var data = $.ajax({
            url: "./product/edit_img/",
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data, // Setting the data attribute of ajax with file_data
            type: 'post',
            async: false
        })
        $(this).parent().parent().find("img").attr("src", data.responseText)
    })
    $(document).on('click', '.delete_img', function(e) {
        var src_img = $(this).parent().parent().find("img").attr("src")
        var id_img = $(this).parent().parent().find("img").attr("data-img")
        var form_data = new FormData()
        form_data.append("src_img", src_img)
        form_data.append("id_img", id_img)
        if ($(".scms_img_upload .action").length == 1) {
            showAlert(
                "Lỗi xóa hình!",
                "Bạn không thể xóa hình vì sản phẩm phải có ít nhất 1 hình sản phẩm."
            )
            setTimeout(function() {
                $(".notification").remove()
            }, 2000)
        } else {
            var data = $.ajax({
                url: "./product/delete_img/",
                dataType: 'script',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data, // Setting the data attribute of ajax with file_data
                type: 'post',
                async: false
            })
            if (data.responseText == "0") {
                $(this).parent().parent().remove()
            }
        }
    })
    $(document).on('click', '.add_new_img', function(e) {
        var file_data = $(this).parent().parent().find("#input-img-edit").prop("files")[0]
        var id_img = $(this).parent().parent().find("img").attr("data-img")
        var form_data = new FormData()
        var size = (file_data.size % 1000)
        var parentLi = $(this).parent().parent()
        var parentDiv = $(this).parent()

        form_data.append("file", file_data)
        form_data.append("id_file", id_img)


        if (size > 0.01) {
            $(this).parent().css("display", "none")
            $(this).parent().parent().find(".loading-upload").css("display", "block")
            currentPercent = 0;
            var check = setInterval(function() {
                setBar(parentLi, currentPercent++)
                if (currentPercent > 100) {
                    currentPercent = 0
                }
            }, 10)

            setTimeout(function() {
                var data = $.ajax({
                    url: "./product/add_image/",
                    dataType: 'script',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    async: false
                })
                if (data.responseText.length > 0) {
                    clearInterval(check)
                    parentLi.find(".loading-upload").remove()
                    parentDiv.css("display", "flex")
                    var id_current_prd = id_img.split("-")
                    var json_data = JSON.parse(data.responseText)
                    var data_img = "0-" + json_data.id_new_img + "-" + id_current_prd[1]
                    parentLi.find("img").attr("data-img", data_img)
                    parentLi.find("img").attr("src", json_data.src_img)
                    parentDiv.html(`<span class="edit_img">Sửa</span><span class="delete_img">Xóa</span>`)
                }
            }, 3000)
        }



    });

    $(document).on('click', '.notification-close', function(e) {
        $(this).parent().remove()
    })
	$(document).on('keyup', '#input-name-prd', function(e){
		e.preventDefault()
		var str = $(this).val();
		str = str.toLowerCase();
		str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
		str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
		str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
		str = str.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
		str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
		str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
		str = str.replace(/đ/g, "d");
		str = str.replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g, "-");
		str = str.replace(/-+-/g, "-"); //thay thế 2- thành 1-
		str = str.replace(/^\-+|\-+$/g, ""); //cắt bỏ ký tự - ở đầu và cuối chuỗi
		$("#input-alias-prd").val(str)
	})
    $("#btn-submit-delete-prd").click(function() {

        if (document.getElementById("list-id-prd").value == "") {
            $(".notification").remove()
            showAlert(
                "Lỗi chọn sản phẩm!",
                "Bạn phải chọn ít nhất một sản phẩm."
            )
            setTimeout(function() {
                $(".notification").remove()
            }, 2000)
        } else {
            confirmAlert("Bạn có muốn xóa!", "Nhấn đồng ý để xóa.")
        }
    })
    $(document).on("click", "#confirm-check", function() {
        loadingProgress();
        $(".notification").remove()
        var listIdPrd = $("#list-id-prd").val()
        var formData = new FormData()
        formData.append("list-id-prd", listIdPrd)
        var request = $.ajax({
            url: BASE_URL + "/product/delete_product/",
            dataType: 'script',
            cache: false,
            contentType: false,
            processData: false,
            data: formData, // Setting the data attribute of ajax with file_data
            type: 'post'
        })
        request.done(function(msg) {
            if (msg == "OK") {
                $(".loading-windows").remove()
                $("body").css("overflow", "auto")
                var arr_id = listIdPrd.split(",")
                for (var i = 0; i < arr_id.length; i++) {
                    $("#prd_" + arr_id[i]).parent().parent().remove()
                }
            }else{
				noty({title: "lỗi! Vui lòng xem lại.", style: "success", css:"custom", time: 2000})
			}
        });
    })

    $("#sh_search_bar span").click(function () {
        // $.get(BASE_URL+"/product/search/0/"+$(this).parent().find("#key_search").val() , function (data) {
        //     alert(data)
        // })
        window.location.href = BASE_URL+"/product/search/0/"+$(this).parent().find("#key_search").val()
    })
	
	
	$(".scms_login .header-tab li").click(function(){
		var position = $(this).index()
		var url = window.location.href.split("=");
		if(position == 0){
			window.history.pushState("", "", url[0]+"=login");
		}else if(position == 1){
			window.history.pushState("", "", url[0]+"=register");
		}
	})


})


//xoa list prd
var array_id_prd = []

function DeleteProductId(id) {
    var text_id = "";
    if (document.getElementById('prd_' + id).checked == true) {
        array_id_prd.push(id)
        for (var i = 0; i < array_id_prd.length; i++) {
            text_id = text_id + array_id_prd[i] + ","
        }
    } else {
        if (document.getElementById('prd_' + id).checked == false) {
            for (var i = 0; i < array_id_prd.length; i++) {
                if (array_id_prd[i] == id) {
                    for (var j = i; j < array_id_prd.length; j++) {
                        array_id_prd[j] = array_id_prd[j + 1]
                    }
                 }
            }
            text_id = "";
            array_id_prd.length--;
            for (var i = 0; i < array_id_prd.length; i++) {
                text_id = text_id + array_id_prd[i] + ","
            }
        }
    }
    document.getElementById('list-id-prd').value = text_id.substr(0, (text_id.length - 1))
}

function showAlert(title, content, style = "warning") {
	var content = `<div class="notification ` + style + `">
                            <span class="notification-close">&times;</span>
                            <h3 class="notification-title">` + title + `</h3>
                            <p class="notification-message">` + content + `</p>
                        </div>`
    $("body").append(content)
}

function confirmAlert(title, content) {
	var content = `<div class="notification info">
                        <span class="notification-close">&times;</span>
                        <h3 class="notification-title">` + title + `</h3>
                        <p class="notification-message">` + content + `</p>
                        <button id="confirm-check">Chấp nhận</button>
                        <button>Hủy</button>
                    </div>`
    $("body").append(content)
}

function loadingProgress() {
    $("body").append(`<div class="loading-windows">
            <span>. . . . . .</span>
        </div>`)
}

function updateFast(id) {
    var formData = new FormData()
    formData.append("name-prd", $('#form_info_prd input[name=name-prd]').val())
    formData.append("alias-prd", $('#form_info_prd input[name=alias-prd]').val())
    formData.append("ksu-prd", $('#form_info_prd input[name=ksu-prd]').val())
    formData.append("brand-prd", $('#form_info_prd select[name=brand-prd]').val())
    formData.append("price-prd", $('#form_info_prd input[name=price-prd]').val())
    formData.append("sale-off-prd", $('#form_info_prd input[name=sale-off-prd]').val())
    formData.append("size-prd", $('#form_info_prd input[name=size-prd]').val())
    formData.append("sex-prd", $('#form_info_prd select[name=sex-prd]').val())
    formData.append("color-prd", $('#form_info_prd input[name=color-prd]').val())
    formData.append("info-prd", $('#form_info_prd textarea[name=info-prd]').val())
    formData.append("public-prd", $('#form_info_prd select[name=public-prd]').val())
    var check = $.ajax({
        url: BASE_URL + "/product/progress_edit_prd/" + id + "/1",
        type: "POST",
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        async: false,
    });
    showAlert(
        "Thành công!",
        "Bạn đã cập nhật thông tin sản phẩm thành công.",
        "success"
    )
    if (check.responseText == "1") {
        setTimeout(function() {
            $(".notification").remove()
        }, 3000)
    }
}
function checkSubmitPrdForm(){
	var title = document.forms["addNewPrd"]["name-prd"].value;
	var alias = document.forms["addNewPrd"]["alias-prd"].value;
	var ksu = document.forms["addNewPrd"]["ksu-prd"].value;
	var price = document.forms["addNewPrd"]["price-prd"].value;
	
	if(title == "" || alias == "" || ksu == "" || price == ""){
		noty({title: "Lỗi! Bạn chưa điền đủ thông tin.", style: "info", css:"custom", time: 2000})
		return false
	}
}
// {title, style, custom css, timeout}
function noty(obj){
    var content = `
    <div class='scms-notify-`+obj.style+` `+obj.css+` scms_notify'> 
        <span>`+obj.title+`</span>
    </div>`
	document.getElementsByTagName("BODY")[0].innerHTML +=content
    setTimeout(function(){
		var e = document.getElementsByClassName("scms_notify")[0]
		e.classList.add("scms_delay")
    },200)
    setTimeout(function(){
        var body = document.getElementsByTagName("BODY")[0]
		var scms_notify = document.getElementsByClassName("scms_notify")[0]
		body.removeChild(scms_notify)
    }, obj.time)
}
function userRegister(){
	var user = document.getElementById("userLo").value
	var pass = document.getElementById("passLo").value
	$.post(BASE_URL+"/user/register", {user:user,pass:pass}, function(data){
		if(data == 1){
			noty({title: "Thành công! Bạn đã đăng ký thành công.", style: "success", css:"custom", time: 3000})
		}else{
			noty({title: "Lỗi! Bạn chưa điền đủ thông tin.", style: "info", css:"custom", time: 3000})
		}
	})
}
function userLogin(){
	var user = document.getElementById("userLo").value
	var pass = document.getElementById("passLo").value
	$.post(BASE_URL+"/api/login_check", {user:user,pass:pass}, function(data){
		console.log(data)
		if(data == 1){
			noty({title: "Thành công! Đăng nhập thành công.", style: "success", css:"custom", time: 3000})
			setTimeout(function(){
				window.location.href=BASE_URL
			},1000)
		}else{
			noty({title: "Lỗi! Đăng nhập thất bại.", style: "info", css:"custom", time: 3000})
		}
	})
}

function productPublic(status, id){
	$("#p2_a_"+id).prepend("<l class='spin icon_spin'></l>")
	$.post(BASE_URL+"/product/product_status", {status:status, id:id}, function(data){
		if(data == 1){
			setTimeout(function(){
				$("#p2_a_"+id + " .icon_spin").remove()
			},2000)
			noty({title: "Thành công! Đã cập nhật thành công.", style: "success", css:"custom", time: 2000})
			if(status == 0){
				$("#p2_a_"+id).removeClass("btn_info")
				$("#p2_a_"+id).addClass("btn_warning")
				$("#p2_a_"+id).text("Hết hàng")
				$("#p2_a_"+id).attr("onclick", "productPublic(1,"+id+")")
			}else{
				$("#p2_a_"+id).removeClass("btn_warning")
				$("#p2_a_"+id).addClass("btn_info")
				$("#p2_a_"+id).text("Còn hàng")
				$("#p2_a_"+id).attr("onclick", "productPublic(0,"+id+")")
			}
			
		}else{
			setTimeout(function(){
				$("#p2_a_"+id + " .icon_spin").remove()
			},2000)
			noty({title: "Lỗi! Cập nhật thất bại.", style: "info", css:"custom", time: 3000})
		}
	})
}
var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

function fastSearch(){
	var key = document.getElementById("key_search").value;
	delay(function(){
		$.get(BASE_URL+"/product/search/1/"+key, function(data){
			var res = JSON.parse(data)
			var list_prds = res.list_prds
			console.log(res)
			var content
			list_prds.forEach(function(i, index){
				content += `
					<tr class="item item_`+i.id_prd+`">
						<td><input type="checkbox"
								   name="prd_item_`+i.id_prd+`"
								   id="prd_`+i.id_prd+`"
								   value="`+i.id_prd+`"
								   onclick="DeleteProductId(`+i.id_prd+`)"
							></td>
						`+(((i.src_prd).split(".")[2] == "svg")
							? `<td><img src='`+i.src_prd+`'></td>` 
							: `<td><img src="`+BASE_URL+`/crop_image/?src=`+BASE_URL+i.src_prd+`&w=50&h=50" alt="Image"></td>`)+`
						
						<td><a href="`+BASE_URL+`/product/detail/`+i.id_prd+`">
								`+i.name_prd+`</a>
						</td>
						<td>`+i.price_prd+` VNĐ</td>
						<td>
							`+(i.public_prd == 0 
							? `<span class='btn btn_warning btn_xs' id='p2_a_`+i.id_prd+`' 
									onclick='productPublic(1,`+i.id_prd+`)'>
									Hết hàng
								</span>` 
							: `<span class='btn btn_info btn_xs' id='p2_a_`+i.id_prd+`' 
									onclick='productPublic(0,`+i.id_prd+`)'>
									Còn hàng
								</span>`)+`
						</td>
					</tr>`
					$(".scms_list_prd table tbody").html(content)
			})
		})
	}, 500)
}
function brandDetail(id){
	$.post(BASE_URL+"/brand/detail", {id:id, status:"1"}, function(data){
		var res = JSON.parse(data)
		var content = `
			<div class="scms_modal">
				<div class="scms_modal_backdrop"></div>
				<div class="scms_modal_content">
					<span class="scms_modal_close">&#x2715;</span>
					<h3>`+res.name_brand+`</h3>
					<input class="ipt" id="input-name-prd"  value="`+res.name_brand+`">
					<input class="ipt" id="input-alias-prd" readonly="" value="`+res.alias_brand+`">
					<span class="btn btn_info btn_sm scms_modal_btn" onclick="brandEdit(`+id+`)">Lưu lại</span> 
				  </div> 
			</div>
		`
		$(".primary_content").append(content)
		$(".scms_modal_close").click(function(){
			$(this).parent().parent().remove()
		})
	})
}
function btnbrandAdd(){
	var content = `
			<div class="scms_modal">
				<div class="scms_modal_backdrop"></div>
				<div class="scms_modal_content">
					<span class="scms_modal_close">&#x2715;</span>
					<h3>Thêm mới hãng</h3>
					<input class="ipt" id="input-name-prd"  placeholder="Nhập tên hãng">
					<input class="ipt" id="input-alias-prd" readonly="">
					<span class="btn btn_info btn_sm scms_modal_btn" onclick="brandAdd()">Lưu lại</span> 
				  </div> 
			</div>
		`
		$(".primary_content").append(content)
		$(".scms_modal_close").click(function(){
			$(this).parent().parent().remove()
		})
}
function brandAdd(){
	var name = document.getElementById("input-name-prd").value
	var alias = document.getElementById("input-alias-prd").value
	$.post(BASE_URL+"/brand/add", {name:name, alias:alias}, function(data){
		if(data != 0){
			setTimeout(function(){
				$(".scms_modal").remove()
			},500)
			noty({title: "Thành công!.", style: "success", css:"custom", time: 2000})
			setTimeout(function(){
				window.location.href = window.location.href
			},2000)
		}else{
			setTimeout(function(){
				$(".scms_modal").remove()
			},500)
			noty({title: "Lỗi!.", style: "info", css:"custom", time: 3000})
		}
	})
}
function brandEdit(id){
	var name = document.getElementById("input-name-prd").value
	var alias = document.getElementById("input-alias-prd").value
	$.post(BASE_URL+"/brand/edit", {name:name, alias:alias, id:id}, function(data){
		if(data == 1){
			setTimeout(function(){
				$("#brd_"+id).text(name)
				$(".scms_modal").remove()
			},500)
			noty({title: "Thành công!.", style: "success", css:"custom", time: 2000})
		}else{
			setTimeout(function(){
				$(".scms_modal").remove()
			},500)
			noty({title: "Lỗi!.", style: "info", css:"custom", time: 3000})
		}
	})
}

function fastBrandSearch(){
	var key = document.getElementById("key_search").value
	$.post(BASE_URL+"/brand/search", {key:key}, function(data){
		var res = JSON.parse(data)
		var content = ""
		res.forEach(function(i, index){
			content += `
				<tr>
					<td>`+(index + 1)+`</td>
					<td id="brd_`+i.id_brand+`" onclick="brandDetail(`+i.id_brand+`)">`+i.name_brand+`</td>
					<td>`+i.created_date+`</td>
					<td>Xóa</td>
				</tr>
			`
		})
		$(".scms_list_prd table tbody").html(content)
	})
}