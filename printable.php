<script src="js/jquery-1.9.1.min.js"></script>
<script>
	$(function() {
		opener.window.globals.templates.render($('#printable') , 'city-printable', opener.window.globals.city, 'html');
		console.log(opener.window.globals.city);
	});
</script>
<div id="printable"></div>
<script>

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34431316-1']);
  _gaq.push(['_setDomainName', 'crystalballsoft.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
