$(function() {

	// 获取表单
	var form = $('#tougao_form');
 
	// 获取显示消息的div
	var formMessages = $('#form-messages');
	var url = "http://localhost/myblog/wordpress/index.php";
	// 为联系表单创建事件监听
	$(form).submit(function(e) {
		// 阻止浏览器直接提交表单
		e.preventDefault();
 
		// 序列化表单数据
		var formData = $(form).serialize();
 
		// 使用AJAX提交表单
		 var s;
		$.ajax({
			type: 'POST',
			url: $(form).attr('action'),
			async:true,
			data: formData,
			cache:false,
			//'success':function(){
			//window.location.href=url

			//}
				
		})
		
		
		.done(function(response) {
			// 确保formMessages的div有“success”这个类
			$(formMessages).removeClass('error');
			$(formMessages).addClass('success');
 
			// 设置消息文本
			$(formMessages).text(response);
 
			// 清除表单
			$('#tougao_authorname').val('');
			$('#tougao_authoremail').val('');
			$('#message').val('');
			$('#tougao_title').val('');
			$('#tougao_content').val('');
		})
		.fail(function(data) {
			// 确保formMessages的div有“error”这个类
			$(formMessages).removeClass('success');
			$(formMessages).addClass('error');
 
			// 设置消息文本
			if (data.responseText !== '') {
				$(formMessages).text(data.responseText);
			} else {
				$(formMessages).text('糟糕！发生错误');
			}
		});
 
	});
 
});