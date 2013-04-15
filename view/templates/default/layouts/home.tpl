<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<!-- HEADER  -->
		{include file='system/common/htmlHeader.tpl'}
		<!-- END OF HEADER  -->
	</head>
	<body>
		<div class="wrapper">
			<!-- header -->
			<div class="header">
				{chunk file="layout/header.tpl"}
			</div>
			<!-- navigation -->
			<div class="navigation">
				{chunk file="layout/navigation.tpl"}
			</div>	
			<!-- content -->
			<div class="content fixed-content">
				<div class="page">
					{include file=$__modulePageTpl}
				</div>
				<div class="sidebar">
					{chunk file="sidebar.tpl"}
				</div>
				<div class="clearboth"> </div>
			</div>
			<!-- footer -->
			<div class="footer">
				{chunk file="layout/footer.tpl"}
			</div>
		</div>
        <!-- Add MSG SYS dialog -->
        {chunk file='msg_sys.tpl'}
	</body>
</html>