<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?> 
<div id="search" class="s-search mx-auto my-4">
    <div id="search-list" class="hide-type-list">
        <div class="s-type">
            <span></span>
            <div class="s-type-list">
                <label for="m_type-baidu">常用</label>
                <label for="m_type-search">搜索</label>
                <label for="m_type-br">工具</label>
                <label for="m_type-zhihu">社区</label>
                <label for="m_type-taobao1">生活</label>
                <label for="m_type-zhaopin">求职</label>
            </div>
        </div>
        <div class="search-group group-a">
            <span class="type-text">常用</span>
            <ul class="search-type">
                <li><input checked="checked" hidden type="radio" name="type2" id="m_type-baidu" value="https://www.baidu.com/s?wd=" data-placeholder="百度一下"><label for="m_type-baidu"><span style="color:#2100E0">百度</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-google" value="https://www.google.com/search?q=" data-placeholder="谷歌两下"><label for="m_type-google"><span style="color:#3B83FA">G</span><span style="color:#F3442C">o</span><span style="color:#FFC300">o</span><span style="color:#4696F8">g</span><span style="color:#2CAB4E">l</span><span style="color:#F54231">e</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-zhannei" value="<?php bloginfo('url') ?>?s=" data-placeholder="站内搜索"><label for="m_type-zhannei"><span style="color:#888888">站内</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-taobao" value="https://s.taobao.com/search?q=" data-placeholder="淘宝"><label for="m_type-taobao"><span style="color:#f40">淘宝</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-bing1" value="https://cn.bing.com/search?q=" data-placeholder="微软Bing搜索"><label for="m_type-bing1"><span style="color:#007daa">Bing</span></label></li>
            </ul>
        </div>
        <div class="search-group group-b">
            <span class="type-text">搜索</span>
            <ul class="search-type">
                <li><input hidden type="radio" name="type2" id="m_type-search" value="https://www.baidu.com/s?wd=" data-placeholder="百度一下"><label for="m_type-search"><span style="color:#2319dc">百度</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-google1" value="https://www.google.com/search?q=" data-placeholder="谷歌两下"><label for="m_type-google1"><span style="color:#3B83FA">G</span><span style="color:#F3442C">o</span><span style="color:#FFC300">o</span><span style="color:#4696F8">g</span><span style="color:#2CAB4E">l</span><span style="color:#F54231">e</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-360" value="https://www.so.com/s?q=" data-placeholder="360好搜"><label for="m_type-360"><span style="color:#19b955">360</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-sogo" value="https://www.sogou.com/web?query=" data-placeholder="搜狗搜索"><label for="m_type-sogo"><span style="color:#ff5943">搜狗</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-bing" value="https://cn.bing.com/search?q=" data-placeholder="微软Bing搜索"><label for="m_type-bing"><span style="color:#007daa">Bing</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-sm" value="https://yz.m.sm.cn/s?q=" data-placeholder="UC移动端搜索"><label for="m_type-sm"><span style="color:#ff8608">神马</span></label></li>
            </ul>
        </div>
        <div class="search-group group-c">
            <span class="type-text">工具</span>
            <ul class="search-type">
                <li><input hidden type="radio" name="type2" id="m_type-br" value="http://rank.chinaz.com/all/" data-placeholder="请输入网址(不带http://)"><label for="m_type-br"><span style="color:#55a300">权重查询</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-links" value="http://link.chinaz.com/" data-placeholder="请输入网址(不带http://)"><label for="m_type-links"><span style="color:#313439">友链检测</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-icp" value="https://icp.aizhan.com/" data-placeholder="请输入网址(不带http://)"><label for="m_type-icp"><span style="color:#ffac00">备案查询</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-ping" value="http://ping.chinaz.com/" data-placeholder="请输入网址(不带http://)"><label for="m_type-ping"><span style="color:#00599e">PING检测</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-404" value="http://tool.chinaz.com/Links/?DAddress=" data-placeholder="请输入网址(不带http://)"><label for="m_type-404"><span style="color:#f00">死链检测</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-ciku" value="http://www.ciku5.com/s?wd=" data-placeholder="请输入关键词"><label for="m_type-ciku"><span style="color:#016DBD">关键词挖掘</span></label></li>
            </ul>
        </div>
        <div class="search-group group-d">
            <span class="type-text">社区</span>
            <ul class="search-type">
                <li><input hidden type="radio" name="type2" id="m_type-zhihu" value="https://www.zhihu.com/search?type=content&q=" data-placeholder="知乎"><label for="m_type-zhihu"><span style="color:#0084ff">知乎</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-wechat" value="http://weixin.sogou.com/weixin?type=2&query=" data-placeholder="微信"><label for="m_type-wechat"><span style="color:#00a06a">微信</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-weibo" value="http://s.weibo.com/weibo/" data-placeholder="微博"><label for="m_type-weibo"><span style="color:#e6162d">微博</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-douban" value="https://www.douban.com/search?q=" data-placeholder="豆瓣"><label for="m_type-douban"><span style="color:#55a300">豆瓣</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-why" value="https://ask.seowhy.com/search/?q=" data-placeholder="SEO问答社区"><label for="m_type-why"><span style="color:#428bca">搜外问答</span></label></li>
            </ul>
            </div>
        <div class="search-group group-e">
            <span class="type-text">生活</span>
            <ul class="search-type">
                <li><input hidden type="radio" name="type2" id="m_type-taobao1" value="https://s.taobao.com/search?q=" data-placeholder="淘宝"><label for="m_type-taobao1"><span style="color:#f40">淘宝</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-jd" value="https://search.jd.com/Search?keyword=" data-placeholder="京东"><label for="m_type-jd"><span style="color:#c91623">京东</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-xiachufang" value="http://www.xiachufang.com/search/?keyword=" data-placeholder="下厨房"><label for="m_type-xiachufang"><span style="color:#dd3915">下厨房</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-xiangha" value="https://www.xiangha.com/so/?q=caipu&s=" data-placeholder="香哈菜谱"><label for="m_type-xiangha"><span style="color:#930">香哈菜谱</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-12306" value="http://www.12306.cn/?" data-placeholder="12306"><label for="m_type-12306"><span style="color:#07f">12306</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-qunar" value="https://www.qunar.com/?" data-placeholder="去哪儿"><label for="m_type-qunar"><span style="color:#00afc7">去哪儿</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-快递100" value="http://www.kuaidi100.com/?" data-placeholder="快递100"><label for="m_type-快递100"><span style="color:#3278e6">快递100</span></label></li>
            </ul>
        </div>
        <div class="search-group group-f">
            <span class="type-text">求职</span>
            <ul class="search-type">
                <li><input hidden type="radio" name="type2" id="m_type-zhaopin" value="https://sou.zhaopin.com/jobs/searchresult.ashx?kw=" data-placeholder="智联招聘"><label for="m_type-zhaopin"><span style="color:#689fee">智联招聘</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-51job" value="https://search.51job.com/?" data-placeholder="前程无忧"><label for="m_type-51job"><span style="color:#ff6000">前程无忧</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-lagou" value="https://www.lagou.com/jobs/list_" data-placeholder="拉钩网"><label for="m_type-lagou"><span style="color:#00b38a">拉钩网</span></label></li>
                <li><input hidden type="radio" name="type2" id="m_type-liepin" value="https://www.liepin.com/zhaopin/?key=" data-placeholder="猎聘网"><label for="m_type-liepin"><span style="color:#303a40">猎聘网</span></label></li>
            </ul>
        </div>
    </div>
    <form action="?s=" method="get" target="_blank" class="super-search-fm">
        <input type="text" id="m_search-text" class="form-control search-key" placeholder="输入关键字搜索" style="outline:0">
        <button type="submit"><i class="iconfont icon-search"></i></button>
    </form>
    <div class="set-check hidden-xs">
        <input type="checkbox" id="set-search-blank" class="bubble-3" autocomplete="off">
    </div>
</div>
