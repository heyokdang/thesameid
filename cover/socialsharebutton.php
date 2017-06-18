<div class="row socialsharebutton">
	<div class="col-xs-4 col-sm-3">
		<div class="fb-like" data-href="http://<?php echo $urlfb ?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="false" data-share="true"></div>
	</div>
	<div class="col-xs-4 col-sm-3">
		<!-- Place this tag where you want the share button to render. -->
		<div class="g-plus" data-action="share" data-href="http://<?php echo $urlfb ?>">
	</div>
	</div>
	<div class="col-xs-4 col-sm-3">
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://<?php echo $urlfb ?>" data-text="<?php echo $descriptionfb ?>" data-via="loan_calc">Tweet</a>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	</div>
	<div class="col-xs-4 col-sm-3">
		<a href="//www.reddit.com/submit" onclick="window.location = '//www.reddit.com/submit?url=' + encodeURIComponent(window.location); return false"> <img src="//www.redditstatic.com/spreddit7.gif" alt="submit to reddit" border="0" /> </a>
	</div>
	<div class="col-xs-4 col-sm-3">
		<script src="//platform.linkedin.com/in.js" type="text/javascript"> lang: en_US</script>
		<script type="IN/Share" data-url="http://<?php echo $urlfb ?>" data-counter="right"></script>
	</div>
</div>