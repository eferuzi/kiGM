<?php 
	require_once 'filter.php';
	
	$translate = $_GET[ 'action' ];
	$id        = $_GET[ 'id' ];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Title      : Imprimis
Version    : 1.0
Released   : 20090510
Description: A two-column fixed-width template suitable for small websites.

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>kiGM - GlossMaster on Diet </title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="css/default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="wrapper">
	<div id="header">
		<div id="logo">
			<h1><a href="#">kiGM</a></h1>
			<h2><a href="http://www.freecsstemplates.org/">A Terminology Tool</a></h2>
		</div>
		<!-- end div#logo -->
		<div id="menu">

			<ul>
				<li class="active"><a href="#">home</a></li>
				 <li><?php status(); ?></li>
         <!--
				<li><a href="#">About</a></li>
				<li><a href="#">Contact</a></li> -->
			</ul>
		</div>
		<!-- end div#menu -->
	</div>
	<div id="filter">
	
	</div>
	<!-- end div#header -->
	<div id="page">
	
<?php 
	if ( $translate == 'translate' )
	{
		$query = "SELECT * FROM gm WHERE id =$id";
		
		$result = mysql_query( $query ) or die ( mysql_error() );
		
		$row= mysql_fetch_object($result);
		
		$word = $row->sourceword;
		$definition = $row->definition;
		$comment = $row->comments;
		$kilinux = $row->translation_k;
		$microsoft = $row->translation_m;
		$tzlug = $row->translation_t;
		$tags = $row->tags;
		$definitionsw = $row->definition_sw;
		$commentsw = $row->comments_sw;
		$status = $row->status;
		$translation = $row->translation;
		
		if ( isset( $_GET['word'] ) )
		{
			$translation = $_GET[ 'word' ];

		}
	}
	
	if( $translate == "save" )
	{
		$translation = $_POST[ 'translation' ];
		$definitionsw = $_POST[ 'definition' ];
		$commentsw = $_POST[ 'comments' ];
		$status = $_POST[ 'status' ];
		$tags = $_POST[ 'tags' ];
		
		$query = "UPDATE gm SET translation='$translation', definition_sw='$definitionsw', comments_sw='$commentsw', status=$status, tags='$tags' WHERE id=$id";
		
		$result = mysql_query( $query ) or die ( mysql_error() );
		
		$query = "SELECT * FROM gm WHERE id =$id";
		
		$result = mysql_query( $query ) or die ( mysql_error() );
		
		$row= mysql_fetch_object($result);
		
		$word = $row->sourceword;
		$definition = $row->definition;
		$comment = $row->comments;
		$kilinux = $row->translation_k;
		$microsoft = $row->translation_m;
		$tzlug = $row->translation_t;
		$tags = $row->tags;
		$definitionsw = $row->definition_sw;
		$commentsw = $row->comments_sw;
		$status = $row->status;
		$translation = $row->translation;
	}
?>	
		<div id="content">
			<div id="workplace">
				<form method="post" action="index1.php?action=save&id=<?php echo $id; ?>">
					<table>
						<tr>
							<td align="right" valign="top">
								Word: 
							</td>
							
							<td>
								<strong>
									<?php echo $word; ?>
								</strong>	
							</td>
						</tr>
						<tr>
							<td align="right" valign="top">
								Definition: 
							</td>
					
							<td>
								<p>
									<strong>
										<?php echo $definition; ?>
									</strong>
								</p>	
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" >
								Comments: 
							</td>
							<td>
								<p>
									<strong>
							<?php 
								if ( $comment == "null" || $comment == "" )
								{
									echo "No comments";
								}
								else
								{
									echo $comment;
								}
							
							?>
							</strong>
							</p>	
							</td>
						</tr>
						<tr>
							<td align="center" colspan="2" >
								Suggestions: 
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" >
								Kilinux: 
							</td>
							<td>
							<?php 
								if ( $kilinux == "null" || $kilinux == "" )
								{
									echo "NONE";
								}
								else
								{
									echo "<a href='index1.php?action=translate&id=$id&word=$kilinux'>$kilinux</a>";
								}
							?>	
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" >
								Microsoft: 
							</td>
							<td>
							<?php
								if ( $microsoft == "null" || $microsoft == ""  )
								{
									echo "NONE";
								}
								else
								{
									echo "<a href='index1.php?action=translate&id=$id&word=$microsoft'>$microsoft</a>";
									$queryinner = "SELECT definition FROM ms m WHERE term='$word'";
									$msresult=mysql_query($queryinner) or die(mysql_error());
									
									$msrow = mysql_fetch_object($msresult);
									echo "<p><strong>". $msrow->definition. "<strong><p>"; 
								}
							?>	
							</td>
						</tr>
						<tr>
							<td align="right" valign="top" >
								tzLUG: 
							</td>
							<td>
							<?php
								if ( $tzlug == "null" || $tzlug == ""  )
								{
									echo "NONE";
								}
								else
								{
									echo "<a href='index1.php?action=translate&id=$id&word=$tzlug'>$tzlug</a>";
								}
							?>	
							</td>
						</tr>
						<tr>
							<td align="right" valign="top">
								Translation: 
							</td>
							<td> 
								<input type="text" class="textbox"  name="translation" id="translation" value="<?php echo $translation; ?>" />
							</td>
						</tr>
						<tr>
							<td align="right" valign="top">
								Definition: 
							</td>
							<td>
								<textarea name="definition" id="definition" ><?php echo $definitionsw; ?></textarea>
							</td>
						</tr>
						<tr>
							<td align="right" valign="top">
								Comments: 
							</td>
							<td>
								<textarea name="comments" id="comments" ><?php echo $commentsw; ?></textarea>
							</td>
						</tr>
						<tr>
							<td align="right" valign="top">
								Tags: 
							</td>
							<td>
								<input type="text" class="textbox" name="tags" id="tags" value="<?php echo $tags; ?>"  />
							</td>
						</tr>	
						<tr>
							<td align="right" valign="top">
								Status: 
							</td>
							<td>
							<?php
			
							if ( $status == 0 )
							{
								echo "<input type='radio' name='status' value='0' checked /> Fuzzy";
							}
							else
							{
								echo "<input type='radio' name='status' value='0' /> Fuzzy";
							}
							
							
							if ( $status == 1 )
							{
								echo "<input type='radio' name='status' value='1' checked /> Complete";
							}
							else
							{
								echo "<input type='radio' name='status' value='1' /> Complete";
							}
							?>
							
							</td>
						</tr>	
						<tr>
							<td align="center" colspan="2">
								<input type="submit"  value="Submit"/> 
							</td>
							
						</tr>				
					</table>
				</form>
			</div>			
		</div>
		<!-- end div#content -->
		<div id="sidebar">
			<form action="filter.php">
				<table>
					<tr>
						<td align="center">
							Search
						</td>
					</tr>
					<tr>
						<td >
							<input name="searchkey" id="searchkey" type="text"/>
						</td>
					</tr>
					<tr>
						<td align="center">
							<input type="submit" value="Filter" />
						</td>
					</tr>
				</table>
			</form>
			<h2>Terms</h2>
			<br />
			<div id="results" class="results">
<?php 
				filter();
?>			
			</div>
			</div>
		<!-- end div#sidebar -->
		<div style="clear: both; height: 1px"></div>
	</div>
	<!-- end div#page -->
	<div id="footer">
		<p id="legal">Copyright &copy; 2007 Imprimis. All Rights Reserved. Designed by <a href="http://www.freecsstemplates.org/">Free CSS Templates</a>.</p>
		<p id="links"><a href="#">Privacy Policy</a> | <a href="#">Terms of Use</a></p>
	</div>
	<!-- end div#footer -->
</div>
<!-- end div#wrapper -->
<div style="text-align: center; font-size: 0.75em;">Design downloaded from <a href="http://www.freewebtemplates.com/">free website templates</a>.</div></body>
</html>
