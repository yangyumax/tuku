<?php require('./config.php');?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>百度图床 | 免费图床-微博图床-免费CDN图床-图床API</title>
    <link rel="shortcut icon" type="image/x-icon" href="https://www.heimi88.com/favicon.ico" />
    <meta name="description" content="永久免费图床，支持批量上传，即时预览，不限制流量，不限制外链数，永久保存，百度图片服务器，全网CDN图床，高速稳定,支持网页、手机上传，无需插件。支持JPG, GIF, PNG等文件格式。微博图床，围脖是个好图床。">
    <meta name="keywords" content="百度图床,图床API,图床,免费图床,CDN图床,淘宝免费图床,淘宝图床,围脖是个好图床,围脖图床,网络图片,图片库,相册,网络相册">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/sentsin/layui/dist/css/layui.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.2.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/layui-src@2.5.5/dist/layui.all.js"></script>
    <style>
        #test1{padding:45px;border:1pxsolid;border-style:dashed;border-radius:15px;}#test1{padding:45px;border:1px solid;border-style:dashed;border-radius:15px;}.url{position:absolute;right:11px;top:6px;display:inline-block;height:23px;line-height:23px;padding:0 10px;background-color:#009688;color:#fff;white-space:nowrap;text-align:center;font-size:10px;border:none;border-radius:2px;cursor:pointer;}.layui-input,.layui-select,.layui-textarea{height:25px!important;}
    </style>
</head>
<body>
<fieldset class="layui-elem-field layui-field-title" style="margin-top: 20px;">
  <legend align="center"><a id="a" onclick="a();">百度图床-黑米娱乐网www.heimi88.com</a></legend>
</fieldset>
<div style="padding: 20px; background-color: #F2F2F2;">
    <div class="layui-row layui-col-space15">   
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header" align="center">请勿上传违反法律法规的图片</div>
                <div style="padding: 10px">
                    <div id="test1" style="padding: 45px;">
                        <button type="button" class="layui-btn" style="margin: 0 auto;display: -webkit-box;;border-radius: 30px;">
                            <i class="layui-icon">&#xe67c;</i>点击这里
                        </button>
                        <p style="text-align: center;padding: 7px;color: #666;">或者拖拽图片到这里</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header" align="center">请复制下方外链地址即可使用</div>
                <div class="layui-card-body">
                    <div id="hide" style="flex-wrap: wrap;">
                        <table class="layui-table" lay-size="sm"><thead><tr><th align="center">

                            </th></tr></thead><tbody id="data"><tr><td></td></tr></tbody></table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="layui-col-md12">
            <div class="layui-card">
                <div class="layui-card-header" align="center">最新上传的十条数据</div>
                <div class="layui-card-body">
                    <div id="hide" style="flex-wrap: wrap;">
                        <table class="layui-table" lay-size="sm"><thead></thead><tbody>
                                <?php 
                                    
                                    $arr = json_decode($result,true);
                                    $y = $arr['url'];
                                    $sql = "select * from bd_up order by id desc limit 10";
                                    foreach($pdo->query($sql) as $row){
                                
                                ?>
                                <tr><td><?php echo $row['id']; ?></td><td><?php echo $row['urls']; ?></td></tr>
                                    <?php } ?>
                            </tbody></table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<script src="https://cdn.jsdelivr.net/gh/PandaFlyer/alisuijitupian/us.js"></script>
<script>
    var clipboard = new ClipboardJS('.url');
clipboard.on('success', function(e) {
	layer.msg('复制成功!');
});
clipboard.on('error', function(e) {
	layer.msg('复制成功!');
});
layui.use('upload', function() {
	var upload = layui.upload;
	var uploadInst = upload.render({
		elem: '#test1',
		url: "./bd.php",
		accept: 'images',
		size: 102400,
		number: 0,
		multiple: true,
		acceptMime: 'image/*',
		allDone: function(obj) {
			layer.msg("上传完毕")
		},
		before: function() {
			layer.msg('正在上传中~~~', {
				icon: 16,
				shade: 0.01,
				time: 9999999999
			});
		},
		done: function(res, index) {
			if (res == -1) {
				layer.alert(res.msg);
			} else {
				$("#data")
					.prepend('<tr><td><input type="text" style="position: relative;color: #333;" name="title" lay-verify="title" autocomplete="off" value="' + res.url + '" class="layui-input"><span class="url" data-clipboard-text="' + res.url + '">复制</span>' + '</td></tr>');
			}
			console.log(index);
		},
		error: function() {
			layer.alert("上传失败！可能原因网速过慢。");
		}
	});
});
</script>
</body>
</html>
<?php $pdo=null;?>