;(function($){
	$(document).ready(function(){
		$('.btnend').on('click',function(){
			var url = new URL(location.href);
			url.searchParams.append('xbnotice',1);
			// Add nonce for security (if available in global JS vars)
			if (typeof shopToolkitNotice !== 'undefined' && shopToolkitNotice.nonce) {
				url.searchParams.append('_wpnonce', shopToolkitNotice.nonce);
			}
			location.href= url;
		});
	});
})(jQuery);