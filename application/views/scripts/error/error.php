<h2>An error occurred</h1>
<h2><?php echo $this->message ?></h2>

<?php if ('development' == APPLICATION_ENV): ?>

<h3>Exception information:</h3>
<p>
  <b>Message:</b> <?php echo $this->exception->getMessage() ?>
</p>

<h3>Stack trace:</h3>
<pre><?php echo $this->exception->getTraceAsString() ?>
</pre>

<h3>Request Parameters:</h3>
<pre><?php echo var_export($this->request->getParams(), true) ?>
</pre>
<?php endif ?>

