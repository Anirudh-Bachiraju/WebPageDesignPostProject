<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>Extra Credit Assignment</title>
</head>

<body id="body">
	<center>
		<h1>Anirudh Bachiraju | Posting Website</h1>
		<br />
		<div id="postingdiv">
			<textarea rows="10" cols="100" name="post" form="form"></textarea>
			<form action="index.php" method="post" id="form">
				<input class="button" name="submit" type="submit">
				
			</form>
		</div>
		<br />
		<hr />
		<br />
	</center>
	<br />
	<hr />

<?php
/* creates an html element, like in js */
class html_element
{
	/* vars */
	var $type;
	var $attributes;
	var $self_closers;
	
	/* constructor */
	function html_element($type,$self_closers = array('input','img','hr','br','meta','link'))
	{
		$this->type = strtolower($type);
		$this->self_closers = $self_closers;
	}
	
	/* get */
	function get($attribute)
	{
		return $this->attributes[$attribute];
	}
	
	/* set -- array or key,value */
	function set($attribute,$value = '')
	{
		if(!is_array($attribute))
		{
			$this->attributes[$attribute] = $value;
		}
		else
		{
			$this->attributes = array_merge($this->attributes,$attribute);
		}
	}
	
	/* remove an attribute */
	function remove($att)
	{
		if(isset($this->attributes[$att]))
		{
			unset($this->attributes[$att]);
		}
	}
	
	/* clear */
	function clear()
	{
		$this->attributes = array();
	}
	
	/* inject */
	function inject($object)
	{
		if(@get_class($object) == __class__)
		{
			$this->attributes['text'].= $object->build();
		}
	}
	
	/* build */
	function build()
	{
		//start
		$build = '<'.$this->type;
		
		//add attributes
		if(count($this->attributes))
		{
			foreach($this->attributes as $key=>$value)
			{
				if($key != 'text') { $build.= ' '.$key.'="'.$value.'"'; }
			}
		}
		
		//closing
		if(!in_array($this->type,$this->self_closers))
		{
			$build.= '>'.$this->attributes['text'].'</'.$this->type.'>';
		}
		else
		{
			$build.= ' />';
		}
		
		//return it
		return $build;
	}
	
	/* spit it out */
	function output()
	{
		echo $this->build();
	}
}
?>
<?php
if(isset($_POST['submit'])) {	
	$post = $_POST["post"];
	// Open the text file
	$f = fopen("data.txt", "a");
	// Write text
	fwrite($f, $post . "\n"); 
	// Close the text file
	fclose($f);
	// Open file for reading, and read the line
	$lines = file('data.txt');
	// Loop through our array, show HTML source as HTML source; and line numbers too.
	foreach ($lines as $line_num => $line) {
	    	$my_anchor = new html_element('p');
		$my_anchor->set('text',$line);
		$my_anchor->set('id',$line_num);
		$my_anchor->output();
	}
}
?>
<?php
$header = file_get_contents('index.php');
file_put_contents('saved.php',$header);
?>
</body>

</html>
