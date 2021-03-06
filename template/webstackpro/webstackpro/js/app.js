
$(function(){ 
	// 点赞
	$(".btn-like").click(function() {
		if ($(this).hasClass('liked')) {
			showAlert(JSON.parse('{"status":3,"msg":"您已经赞过了!"}'));
		} else {
			$('.btn-like').addClass('liked'); 
			$.ajax({
				url : theme.ajaxurl,  
				data : {
					action: "post_like",
					post_id: $(this).data("id")
				},
				type : 'POST',
				success : function( data ){
					showAlert(JSON.parse('{"status":1,"msg":"谢谢点赞!"}'));
                    $('.like-count').html(data);
				},
                error:function(){ 
					showAlert(JSON.parse('{"status":4,"msg":"网络错误 --."}'));
                }
			});
		}
		return false;
    });
    //未开启详情页计算访客方法
    $(document).on('click', '.url-card a.is-views[data-id]', function() {
        $.ajax({
            type:"GET",
            url:theme.ajaxurl,
            data:{
                action:'io_postviews',
                postviews_id:$(this).data('id'),
            },
            cache:!1,
        });
    });
    //夜间模式
	$(document).on('click', '.switch-dark-mode', function(event) {
		event.preventDefault();
        $.ajax({
            url: theme.ajaxurl,
            type: 'POST',
            dataType: 'html',
            data: {
				mode_toggle: $('body').hasClass('io-black-mode') === true ? 1 : 0,
				action: 'switch_dark_mode',
            },
        })
        .done(function(response) {
			$('body').toggleClass('io-black-mode '+theme.defaultclass);
            switch_mode(); 
            $("#"+ $('.switch-dark-mode').attr('aria-describedby')).remove();
            //$('.switch-dark-mode').removeAttr('aria-describedby');
        })
    });
    function switch_mode(){
        if($('body').hasClass('io-black-mode')){
            if($(".switch-dark-mode").attr("data-original-title"))
                $(".switch-dark-mode").attr("data-original-title","日间模式");
            else
                $(".switch-dark-mode").attr("title","日间模式");
            $(".mode-ico").removeClass("icon-night");
            $(".mode-ico").addClass("icon-light");
        }
        else{
            if($(".switch-dark-mode").attr("data-original-title"))
                $(".switch-dark-mode").attr("data-original-title","夜间模式");
            else
                $(".switch-dark-mode").attr("title","夜间模式");
            $(".mode-ico").removeClass("icon-light");
            $(".mode-ico").addClass("icon-night");
        }
    }
    //返回顶部
    $(window).scroll(function () {
        if ($(this).scrollTop() >= 50) {
            $('#go-to-up').fadeIn(200);
        } else {
            $('#go-to-up').fadeOut(200);
        }
    });
    $('.go-up').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 500);
    return false;
    }); 

 
    //滑块菜单
    $('.slider_menu').children("ul").children("li").not(".anchor").hover(function() {
        $(this).addClass("hover"),
        //$('li.anchor').css({
        //    transform: "scale(1.05)",
        //}),
        toTarget($(this).parent()) 
    }, function() {
        //$('li.anchor').css({
        //    transform: "scale(1)",
        //}),
        $(this).removeClass("hover") 
    });
    $('.slider_menu').mouseleave(function(e) {
        var menu = $(this).children("ul");
        window.setTimeout(function() { 
            toTarget(menu) 
        }, 50)
    }) ;  
    function intoSlider() {
        $(".slider_menu[sliderTab]").each(function() {
            if(!$(this).hasClass('into')){
                var menu = $(this).children("ul");
                menu.prepend('<li class="anchor" style="position:absolute;width:0;"></li>');
                var target = menu.find('.active').parent();
                if(0 < target.length){
                    menu.children(".anchor").css({
                        left: target.position().left + target.scrollLeft() + "px",
                        width: target.outerWidth() + "px",
                        height: target.height() + "px",
                        opacity: "1"
                    })
                }
                $(this).addClass('into');
            }
        })
    }
    //粘性页脚
    function stickFooter() {
        $('.main-footer').attr('style', '');
	    if($('.main-footer').hasClass('text-xs'))
	    {
	    	var win_height				 = jQuery(window).height(),
	    		footer_height			 = $('.main-footer').outerHeight(true),
	    		main_content_height	     = $('.main-footer').position().top + footer_height ;
	    	if(win_height > main_content_height - parseInt($('.main-footer').css('marginTop'), 10))
	    	{
	    		$('.main-footer').css({
	    			marginTop: win_height - main_content_height  
	    		});
	    	}
        }
    }
 

    $(document).ready(function(){
        // 侧栏菜单初始状态设置
        trigger_resizable(true);
        // 主题状态
        switch_mode(); 
        // 网址块提示 
        $('[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
        // 初始化tab滑块
        intoSlider()
        // 初始化theiaStickySidebar
        $('.sidebar').theiaStickySidebar({
            additionalMarginTop: 90,
            additionalMarginBottom: 20
        });
        // 初始化游客自定义数据
        if(theme.isCustomize == '1'){
            intoSites();
            intoSites(true);
        }
    });

    $('#sidebar-switch').on('click',function(){
        $('#sidebar').removeClass('mini-sidebar');

    }); 
 
    // Trigger Resizable Function
    var isMin = false,
        isMobileMin = false;
    function trigger_resizable(isNoAnim = false)
    {
        stickFooter(); 
        if(!isMin && 767.98<$(window).width() && $(window).width()<1024){
            //$('#mini-button').removeAttr('checked');
            $('#mini-button').prop('checked', false);
            trigger_lsm_mini(isNoAnim);
            isMin = true;
            if(isMobileMin){
                $('#sidebar').addClass('mini-sidebar');
                isMobileMin = false;
            }
        }
        else if((isMin && $(window).width()>=1024) || (isMobileMin && !isMin && $(window).width()>=1024)){
            $('#mini-button').prop('checked', true);
            trigger_lsm_mini(isNoAnim);
            isMin = false;
            if(isMobileMin){
                isMobileMin = false;
            }
        }
        else if($(window).width() < 767.98 && $('#sidebar').hasClass('mini-sidebar')){
            $('#sidebar').removeClass('mini-sidebar');
            isMobileMin = true;
            isMin = false;
        }
    }

    // Enable/Disable Resizable Event
    var wid = 0;
    $(window).resize(function() {
		clearTimeout(wid);
        wid = setTimeout(trigger_resizable, 200); 
    });

    // sidebar-menu-inner收缩展开
    $('.sidebar-menu-inner a').on('click',function(){//.sidebar-menu-inner a //.has-sub a  

        //console.log('--->>>'+$(this).find('span').text());
        if (!$('.sidebar-nav').hasClass('mini-sidebar')) {//菜单栏没有最小化   
            $(this).parent("li").siblings("li.sidebar-item").children('ul').slideUp(200);
            if ($(this).next().css('display') == "none") { //展开
                //展开未展开
                // $('.sidebar-item').children('ul').slideUp(300);
                $(this).next('ul').slideDown(200);
                $(this).parent('li').addClass('sidebar-show').siblings('li').removeClass('sidebar-show');
            }else{ //收缩
                //收缩已展开
                $(this).next('ul').slideUp(200);
                //$('.sidebar-item.sidebar-show').removeClass('sidebar-show');
                $(this).parent('li').removeClass('sidebar-show');
            }
        }
    });
    //菜单栏最小化
    $('#mini-button').on('click',function(){
        trigger_lsm_mini();

    });
    function trigger_lsm_mini( isNoAnim = false){
        if ($('.header-mini-btn input[type="checkbox"]').prop("checked")) {
            $('.sidebar-nav').removeClass('mini-sidebar');
            $('.sidebar-menu ul ul').css("display", "none");
            if(isNoAnim)
            $('.sidebar-nav').width(220);
            else
            $('.sidebar-nav').stop().animate({width: 220},200);
        }else{
            $('.sidebar-item.sidebar-show').removeClass('sidebar-show');
            $('.sidebar-menu ul').removeAttr('style');
            $('.sidebar-nav').addClass('mini-sidebar');
            if(isNoAnim)
            $('.sidebar-nav').width(60);
            else
            $('.sidebar-nav').stop().animate({width : 60},200);
        }
        //$('.sidebar-nav').css("transition","width .3s");
    }
    //显示2级悬浮菜单
    $(document).on('mouseover','.mini-sidebar .sidebar-menu ul:first>li,.mini-sidebar .flex-bottom ul:first>li',function(){
        var offset = 2;
        if($(this).parents('.flex-bottom').length!=0)
            offset = -3;
        $(".sidebar-popup.second").length == 0 && ($("body").append("<div class='second sidebar-popup sidebar-menu-inner text-sm'><div></div></div>"));
        $(".sidebar-popup.second>div").html($(this).html());
        $(".sidebar-popup.second").show();
        var top = $(this).offset().top - $(window).scrollTop() + offset; 
        var d = $(window).height() - $(".sidebar-popup.second>div").height();
        if(d - top <= 0 ){
            top  = d >= 0 ?  d - 8 : 0;
        }
        $(".sidebar-popup.second").stop().animate({"top":top}, 50);
    });
    //隐藏悬浮菜单面板
    $(document).on('mouseleave','.mini-sidebar .sidebar-menu ul:first, .mini-sidebar .slimScrollBar,.second.sidebar-popup',function(){
        $(".sidebar-popup.second").hide();
    });
    //常驻2级悬浮菜单面板
    $(document).on('mouseover','.mini-sidebar .slimScrollBar,.second.sidebar-popup',function(){
        $(".sidebar-popup.second").show();
    });
 

    //首页tab模式请求内容
    $(document).on('click', '.ajax-list a', function(event) {
        event.preventDefault();
        loadAjax( $(this), $(this).parents('.ajax-list') );
    });

    $(document).on('click', '.ajax-list-home a', function(event) {
        event.preventDefault();
        loadAjax( $(this), $(this).parents('.ajax-list-home'), '.ajax-'+$(this).parents('.ajax-list-home').data('id') );
    });

    function loadAjax(t,parent,body = ".ajax-list-body"){
        if( !t.hasClass('active') ){ 
            parent.find('a').removeClass('active');
            t.addClass('active');
            if($(body).children(".ajax-loading").length == 0)
                $(body).append('<div class="ajax-loading text-center rounded" style="position:absolute;display:flex;width:100%;top:-1rem;bottom:.5rem;background:rgba(125,125,125,.5)"><div class="col align-self-center"><i class="iconfont icon-loading icon-spin icon-2x"></i></div></div>');
            $.ajax({
                url: theme.ajaxurl,
                type: 'POST', 
                dataType: 'html',
                data : t.data(),
                cache: true,
            })
            .done(function(response) { 
                if (response.trim()) { 
                    $(body).html('');
                    $(body).append(response); 
                    //if(theme.lazyload == '1') {
                    //    $(body+" img.lazy").lazyload();
                    //} 
                    var url =  $(body).children('#ajax-cat-url').data('url');
                    if(url)
                        t.parents('.d-flex.flex-fill.flex-tab').children('.btn-move.tab-move').show().attr('href', url);
                    else
                        t.parents('.d-flex.flex-fill.flex-tab').children('.btn-move.tab-move').hide();
                    $('.ajax-url [data-toggle="tooltip"]').tooltip({
                        trigger: 'hover'
                    });
                } else { 
                    $('.ajax-loading').remove();
                }
            })
            .fail(function() { 
                $('.ajax-loading').remove();
            }) 
        }
    }
    
    // 自定义模块-----------------
    $(".add-link-form").on("submit", function() {
        var siteName = $(".site-add-name").val()
          , siteUrl = $(".site-add-url").val();
          addSiteList({
            id: +new Date,
            name: siteName,
            url: siteUrl
        });
        this.reset();
        this.querySelector("input").focus();
        $(this).find(".btn-close-fm").click();
    });
    var isEdit = false;
    $('.customize-menu .btn-edit').click(function () {
        if(isEdit){
            $('.url-card .remove-site,#add-site').hide();
            $('.customize-menu .btn-edit').html("编辑网址");
        }else{
            $('.url-card .remove-site,#add-site').show();
            $('.customize-menu .btn-edit').html("确定");
        }
        isEdit = !isEdit;
    }); 
    function addSiteList(site){
        var sites = getItem();
        sites.unshift(site);
        addSite(site);
        setItem(sites);
    }
    function addSite(site,isLive=false,isHeader=false) {
        if(!isLive) $('.customize_nothing').remove();
        else $('.customize_nothing_click').remove();
        var blank ="";
        var url_f,matches = site.url.match(/^(?:https?:\/\/)?((?:[-A-Za-z0-9]+\.)+[A-Za-z]{2,6})/);
        if (!matches || matches.length < 2) url_f=site.url; 
        else {
            url_f=matches[0];
            if(theme.urlformat == '1')
                url_f = matches[1];
        }
        if(theme.newWindow == '1')
            blank = '_blank';
        var newSite = $('<div class="url-card  col-6 col-md-4 col-lg-3 col-xl-2 col-xxl-10">'+
            '<div class="url-body mini"><a href="'+site.url+'" target="'+blank+'" class="card new-site mb-3 site-'+site.id+'" data-id="'+site.id+'" data-url="'+site.url+'" data-toggle="tooltip" data-placement="bottom" title="'+site.name+'">'+
                '<div class="card-body" style="padding:0.4rem 0.5rem;">'+
                '<div class="url-content">'+
                    '<div class="url-img">'+
                        '<img class="rounded-circle" src="' + theme.icourl + url_f + theme.icopng + '" width="25">'+
                    '</div>'+
                    '<div class="url-info" style="padding-top: 2px">'+
                        '<div class="text-sm overflowClip_1">'+
                            '<strong>'+site.name+'</strong>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '</div>'+
            '</a></div>' +
            '<a href="javascript:;" class="text-center remove-site" data-id="'+site.id+'" style="display: none"><i class="iconfont icon-close-circle"></i></a>'+
        '</div>');
        if(isLive){
            if(isHeader)
                $(".my-click-list").prepend(newSite);
            else
                $(".my-click-list").append(newSite);
            newSite.children('.remove-site').on("click",removeLiveSite);
        } else {
            $("#add-site").before(newSite);
            newSite.children('.remove-site').on("click",removeSite);
        }
        if(isEdit)
            newSite.children('.remove-site').show();
        $('.new-site[data-toggle="tooltip"]').tooltip({
            trigger: 'hover'
        });
    }
    function getItem(key = "myLinks") {
        var a = window.localStorage.getItem(key);
        return a ? a = JSON.parse(a) : [];
    }
    function setItem(sites,key = "myLinks") {
        window.localStorage.setItem(key, JSON.stringify(sites));
    }
    function intoSites(isLive = false) {
        var sites = getItem( isLive ? "livelists" : "myLinks" );
        if (sites.length) {
            for (var i = 0; i < sites.length; i++) {
                addSite(sites[i],isLive);
            }
        }
    }
    function removeSite() {
        var id = $(this).data("id"), 
            sites = getItem();
        for (var i = 0; i < sites.length; i++){
            if ( parseInt(sites[i].id) === parseInt(id)) {
                console.log(sites[i].id, id);
                sites.splice(i, 1);
                break;
            }
        }
        setItem(sites);
        $(this).parent().remove();
    }
    function removeLiveSite() {
        var id = $(this).data("id"), 
            sites = getItem("livelists");
        for (var i = 0; i < sites.length; i++){
            if ( parseInt(sites[i].id) === parseInt(id)) {
                console.log(sites[i].id, id);
                sites.splice(i, 1);
                break;
            }
        }
        setItem(sites,"livelists");
        $(this).parent().remove();
    }
    $(document).on('click', '.url-card a.card', function(event) {
        var site = {
            id: $(this).data("id"),
            name: $(this).find("strong").html(),
            url: $(this).data("url")
        };
        if(site.url==="")
            return;
        var liveList = getItem("livelists");
        var isNew = true;
        for (var i = 0; i < liveList.length; i++){
            if (liveList[i].name === site.name) {
                isNew = false;
            }
        }
        if(isNew){
            var maxSite = theme.customizemax;
            if(liveList.length > maxSite-1){
                $(".my-click-list .site-"+liveList[maxSite-1].id).parent().remove();
                liveList.splice(maxSite-1, 1);
            }
            addSite(site,true,true);
            liveList.unshift(site);
            setItem(liveList,"livelists");
        }
    });

    // 搜索模块 -----------------------
    $(document).ready(function(){  
        if(window.localStorage.getItem("searchlist")){
            $(".hide-type-list input#"+window.localStorage.getItem("searchlist")).prop('checked', true);
            $(".hide-type-list input#m_"+window.localStorage.getItem("searchlist")).prop('checked', true);
        }
        $('.hide-type-list input:radio[name="type"]:checked').parents(".search-group").addClass("s-current"); 
        $('.hide-type-list input:radio[name="type2"]:checked').parents(".search-group").addClass("s-current");
 
        $(".super-search-fm").attr("action",$('.hide-type-list input:radio[name="type"]:checked').val());
        $(".search-key").attr("placeholder",$('.hide-type-list input:radio[name="type"]:checked').data("placeholder")); 
    });
    $(document).on('click', '.s-type-list label', function(event) {
        //event.preventDefault();
        var parent = $(this).parents(".s-search");
        parent.find('.search-group').removeClass("s-current");
        parent.find('#'+$(this).attr("for")).parents(".search-group").addClass("s-current"); 
    });
    $('.hide-type-list .search-group input').on('click', function() {
        var parent = $(this).parents(".s-search");
        window.localStorage.setItem("searchlist", $(this).attr("id").replace("m_",""));
        parent.children(".super-search-fm").attr("action",$(this).val());
        parent.find(".search-key").attr("placeholder",$(this).data("placeholder"));
        parent.find(".search-key").select();

        parent.find(".search-key").focus();
    });
    $(document).on("submit", ".super-search-fm", function() {
        var key = $(this).children(".search-key").val()
        if(key == "")
            return false;
        else{
            window.open( $(this).attr("action") + key );
            return false;
        }
    });
});

function showAlert(data) {
    var alert,ico;
    switch(data.status) {
        case 1: 
            alert='success';
            ico='icon-adopt';
           break;
        case 2: 
            alert='info';
            ico='icon-tishi';
           break;
        case 3: 
            alert='warning';
            ico='icon-warning';
           break;
        case 4: 
            alert='danger';
            ico='icon-close-circle';
           break;
        default: 
    } 
    var msg = data.msg;
    if(!$('#alert_placeholder').hasClass('text-sm')){
        $('body').append('<div id="alert_placeholder" class="text-sm" style="position: fixed;bottom: 10px;right: 10px;z-index: 1000;text-align: right;text-align: -webkit-right"></div>')
    }
    $html = $('<div class="alert-body" style="display:none;"><div class="alert alert-'+alert+'"><i class="iconfont '+ico+' icon-lg" style="vertical-align: middle;margin-right: 10px"></i><span style="vertical-align: middle">'+msg+'</span></div></div>');
    $('#alert_placeholder').append( $html );//prepend
    $html.show(200).delay(3000).hide(300, function(){ $(this).remove() }); 
} 
function toTarget(menu) {
    var slider =  menu.children(".anchor");
    var target = menu.children(".hover").first() ;
    if (target && 0 < target.length){
    }
    else{
          target = menu.find('.active').parent();
    }
    if(0 < target.length){
        slider.css({
            left: target.position().left + target.scrollLeft() + "px",
            width: target.outerWidth() + "px",
            opacity: "1"
        })
    }
    else{
        slider.css({
            opacity: "0"
        })
    }
}
