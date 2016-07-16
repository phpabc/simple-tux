 <div id="tab-title">
 <h3><span class="selected">最新日志</span><span>热评日志</span><span>随机日志</span></h3>
    <div id="tab-content">
        <ul><?php tux_most_viewed(); ?></ul>
        <ul class="hide"><?php tux_get_most_commented(); ?></ul>
        <ul class="hide"><?php tux_rand_posts(); ?></ul>
    </div>
 </div>