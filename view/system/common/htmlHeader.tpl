<!-- CSS -->
{foreach from=$__cssFiles item=file}
	<link rel="stylesheet" href="{$file}" type="text/css" />
{/foreach}
<!-- End Of CSS -->

<!-- Start JavaScript -->

{foreach from=$__jsFiles item=file}
	<script type="text/javascript" src="{$file}"></script>
{/foreach}
<!-- End Of JavaScript -->

<title>{$__pageTitle}</title>

{if !empty($__pageDescription)}
	<meta name="description" content="{$__pageDescription}" />
{/if}

{if !empty($__pageKeywords)}
	<meta name="keywords" content="{$__pageKeywords}" />
{/if}

<!-- Custom Head Tags -->
{foreach from=$__CustomHeadTags item=tag}
	{$tag}	
{/foreach}
<!-- Custom Head Tags -->