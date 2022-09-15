<?php

$default_directory = '/home/user/';
$default_text_editor = 'xed';
$safe_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
$directory = $safe_GET['directory'];
$text_editor = $safe_GET['text_editor'];
$local_domain = $safe_GET['local_domain'];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<style type="text/css">
		pre{
			background: #405064;
			color: white;
			padding: 5px 10px 5px;
			box-shadow: 0px 3px 3px #060606;
			border: 1px solid transparent;
			border-radius: 3px;
			margin-top: 10px;
		}
	</style>
</head>
<body>

<div class="col-lg-8 mx-auto p-3 py-md-5">
  <header class="d-flex align-items-center pb-3 mb-4 border-bottom">
    <a href="index.php" class="d-flex align-items-center text-dark text-decoration-none">
	<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-gear-fill me-2" viewBox="0 0 16 16">
	  <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872l-.1-.34zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
	</svg>
      <span class="fs-4">Apache vhost quick setup</span>
    </a>
  </header>

  <main>
	<form class="border-top mt-4 pt-4" action="index.php#formResult" method="get">
	  <div class="mb-3">
	    <label for="directory" class="form-label">Directory:</label>
	    <input class="form-control" type="text" id="directory" name="directory" value="<?php echo (isset($safe_GET['directory'])) ? $directory : $default_directory; ?>" placeholder="/home/user/local_domain_folder/">
	  </div>
	  <div class="mb-3">
	    <label for="text_editor" class="form-label">Text editor :</label>
	    <input class="form-control" type="text" id="text_editor" name="text_editor" value="<?php echo (isset($safe_GET['text_editor'])) ? $text_editor : $default_text_editor; ?>" placeholder="xed / nano / vi;) ...">
	  </div>
	  <div class="mb-3">
	    <label for="local_domain" class="form-label">Local domain name :</label>
	    <input class="form-control" type="text" id="local_domain" name="local_domain" value="<?php echo (isset($safe_GET['local_domain'])) ? $local_domain : ''; ?>" placeholder="domain.local"> 
	  </div>
	  <button type="submit" class="btn btn-primary">Submit</button>
	</form>
  </main>

  <?php
	if(isset($safe_GET['local_domain']) && $safe_GET['local_domain'] != '')
 	{
 	?>
 		<section id="formResult" class="mt-5 p-4 border">
 			<div class="mb-4 pb-3 border-bottom">
	 			<h5>1. Create folder</h5>
	 			<p>
	 				<pre><?php echo 'mkdir ' . $directory  . $local_domain; ?></pre>
	 			</p>
	 		</div>

	 		<div class="mb-4 pb-2 border-bottom">
	 			<h5>2. Add htdocs folder ?</h5>
	 			<div class="form-text">If you want to include a htdocs folder inside your working directory (it will be added in the apache conf bellow).</div>
				<div class="form-check mb-3 mt-3">
					<form autocomplete="off">
					  <label class="form-check-label" for="addHtdocs">
					    Add htdocs folder
					  </label>
					  <input class="form-check-input" type="checkbox" value="" id="addHtdocs">
					 </form>
				  <pre id="addHtdocs_mkdir" class="d-none"><?php echo 'mkdir ' . $directory  . $local_domain; ?>/htdocs</pre>
				</div>
			</div>

	 		<div class="mb-4 pb-5 border-bottom">
	 			<h5>2. Apache conf</h5>
	 			<p>
	 				<pre><?php echo 'sudo ' . $text_editor . ' /etc/apache2/sites-available/' . $local_domain . '.conf'; ?></pre>
	 			</p>

				<div id="enable_ssl" class="alert alert-secondary d-none" role="alert">
				  first time using ssl on your dev LAMP environment ? run :
				  <pre>sudo a2enmod ssl</pre>
				</div>

				<ul class="nav nav-tabs" role="tablist">
				  <li class="nav-item" role="presentation">
				    <button class="nav-link active" id="http-tab" data-bs-toggle="tab" data-bs-target="#http" type="button" role="tab" aria-controls="http" aria-selected="true">HTTP</button>
				  </li>
				  <li class="nav-item" role="presentation">
				    <button class="nav-link" id="ssl-tab" data-bs-toggle="tab" data-bs-target="#ssl" type="button" role="tab" aria-controls="ssl" aria-selected="false">HTTPS</button>
				  </li>
				</ul>
				<div class="tab-content">
			  		<div class="tab-pane fade show active border-bottom p-3 border-start border-end" id="http" role="tabpanel" aria-labelledby="http-tab"

><pre>&lt;VirtualHost *:80&gt;
	ServerName <?php echo $local_domain . PHP_EOL; ?>
	ServerAdmin webmaster@localhost
	  DocumentRoot <?php echo $directory . $local_domain; ?>/<span class="addhtdocs d-none">htdocs/</span>
	  &lt;Directory <?php echo $directory . $local_domain; ?>/<span class="addhtdocs d-none">htdocs/</span>&gt;
	    Options Indexes FollowSymLinks
	    AllowOverride All
	    Require all granted
	  &lt;/Directory&gt;
	ErrorLog ${APACHE_LOG_DIR}/error.log
	CustomLog ${APACHE_LOG_DIR}/access.log combined
&lt;/VirtualHost&gt;</pre></div>

			  	<div class="tab-pane fade  border-bottom p-3 border-start border-end" id="ssl" role="tabpanel" aria-labelledby="ssl-tab"

><pre>&lt;IfModule mod_ssl.c&gt;
	&lt;VirtualHost <?php echo $local_domain; ?>:443&gt;
	  ServerAdmin webmaster@localhost
	     ServerName <?php echo $local_domain . PHP_EOL; ?>
	  DocumentRoot "<?php echo $directory . $local_domain; ?>/<span class="addhtdocs d-none">htdocs/</span>"
	     SSLEngine on
	  SSLCertificateFile /etc/ssl/certs/ssl-cert-snakeoil.pem
	  SSLCertificateKeyFile /etc/ssl/private/ssl-cert-snakeoil.key
	    &lt;Directory "<?php echo $directory . $local_domain; ?>/<span class="addhtdocs d-none">htdocs/</span>"&gt;
	    Require all granted
	    AllowOverride All
	  &lt;/Directory&gt;
	&lt;/VirtualHost&gt;
&lt;/IfModule&gt;</pre></div>

				</div>
			</div>

			<div class="mb-4 pb-3 border-bottom">
				<h5>3. Enable website</h5>
				<pre>sudo a2ensite <?php echo $local_domain; ?></pre>
			</div>

			<div class="mb-4 pb-3 border-bottom">
				<h5>4. Vhost conf</h5>
				<pre class="mb-1">sudo <?php echo $text_editor; ?> /etc/hosts</pre>
				<pre>127.0.1.1	<?php echo $local_domain; ?></pre>
			</div>

			<div class="mb-4 pb-3 border-bottom">
				<h5>5. Restart Apache</h5>
				<pre class="mb-1">sudo service apache2 restart</pre>
			</div>

			<div class="mb-4 pb-3 border-bottom">
				<h5>6. Try it</h5>
				<pre class="mb-3">echo "&lt;?php echo 'hello world'; ?&gt;" > <?php echo $directory . $local_domain; ?>/<span class="addhtdocs d-none">htdocs/</span>index.php</pre>
				<div id="try_http"><a target="_BLANK" href="http://<?php echo $local_domain; ?>">http://<?php echo $local_domain; ?></a></div>
				<div class="d-none" id="try_sll"><a target="_BLANK" href="https://<?php echo $local_domain; ?>">https://<?php echo $local_domain; ?></a></div>
			</div>

 		</section>
 	<?php
 	}
	?>

  <footer class="pt-3 my-5 text-muted border-top">
    Powered by antoinebaron.io
  </footer>

</div>

<script type="text/javascript">
$(document).ready(function() {

    // select inside pre on click
    $('pre').on('click', function() {
        var text = this,
            range, selection;

        if (document.body.createTextRange) {
            range = document.body.createTextRange();
            range.moveToElementText(text);
            range.select();
        } else if (window.getSelection) {
            selection = window.getSelection();
            range = document.createRange();
            range.selectNodeContents(text);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    });

    // on click on "add htdocs checkbox", toogle mkdir ../htdocs + add htdocs where is needed
    $('#addHtdocs').on('click', function(){
    	$('.addhtdocs').toggleClass('d-none');
    	$('#addHtdocs_mkdir').toggleClass('d-none');
    });

    // on click on http/https tab, toogle the try link
    $('#http-tab').on('click', function(){
    	$('#try_http').removeClass('d-none');
    	$('#try_sll').addClass('d-none');
    	$('#enable_ssl').addClass('d-none');
    });
    $('#ssl-tab').on('click', function(){
    	$('#try_http').addClass('d-none');
    	$('#try_sll').removeClass('d-none');
    	$('#enable_ssl').removeClass('d-none');
    	
    });

});
</script>
</body>
</html>
