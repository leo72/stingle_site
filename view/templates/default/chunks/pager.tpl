<table cellpadding="0" cellspacing="0" summary="" class="pager">
	<tr>
		{if isset($pagerPreviousPageLink)}
			<td class="left">
				<span><a href="{$pagerPreviousPageLink}">&#x25c4;</a></span>
				{if $pagerPageNumStart > 1} ...{/if}
			</td>
		{/if}
		
		{if isset($pagerNumbersArray)}
			{foreach from=$pagerNumbersArray item=pagerItem}
				{if $pagerItem.isCurrent}
					<td class="selected">{$pagerItem.pageNum}</td>
				{else}
					<td onmouseover="this.className='hover'" 
						onmouseout="this.className=''" 
						onmousedown="this.className='selected'">
							<span>
								<a href="{$pagerItem.pageLink}">{$pagerItem.pageNum}</a>
							</span>
					</td>
				{/if}
			{/foreach}
		{/if}
		
		{if isset($pagerNextPageLink)}
			<td class="count_pages">... {'FROM_L'|C} {$pagerTotalPagesCount}</td>
			<td class="right">
				<span>
					<a href="{$pagerNextPageLink}">&#x25ba;</a>
				</span>
			</td>
		{/if}
	</tr>
</table>