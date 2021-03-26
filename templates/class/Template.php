<?php
class Template
{
	private $template;
	private $content;

	function __construct($template)
	{
		$this->template = $template;
		$this->content = $this->getContent();
	}

	function setTemplate($template)
	{
		$this->template = $template;
		$this->content = $this->getContent();
	}

	function set($key, $value)
	{
		$this->content = str_replace('${' . $key . '}', $value, $this->content);
	}

	function getContent()
	{
		$tpl = '';

		$file = fopen($this->template, "r");

		while (!feof($file)) {
			$buffer = fgets($file, 4096);
			$tpl .= $buffer;
		}
		fclose($file);

		return $tpl;
	}

	function write($fileName)
	{
		echo $fileName . '<br/>';
		$fd = fopen($fileName, "w");
		fwrite($fd, $this->content);
		fclose($fd);
	}
}
