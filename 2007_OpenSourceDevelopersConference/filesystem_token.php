<?php
require ('token.php');

// filesystem Class (token object version)
class FileSystemTokenObject
{
	public 	$arrPath = Array();
	private $_mtokToken;
	
	// Constructor
	function __Construct()
	{	
		// instanciate multi level token
		$this->_mtokToken 	= new aphplixMultiLevelToken($this);
	}
	
	// _Get
	function __get($strName)
	{
		// clean path
		$this->arrPath = Array();
		
		// clean token
		$this->_mtokToken->NewPath($strName);
		
		// return token
		return $this->_mtokToken;
	}
	
	// _Call
	function __Call($strMethod, $arrArguments)
	{
		// implode the path
		$strPath = "/".implode("/", $this->arrPath);
		
		// we only care about the first argument
		if ($arrArguments[0])
		{
			// add the file name to the path
			$strPath .= "/{$arrArguments[0]}";
		}
		
		// check the passed command
		switch (strtolower($strMethod))
		{
			case 'path':
				// show the path
				return $strPath;
				break;
			
			case 'exists':
				// check if the file exists
				return file_exists($strPath);
				break;
				
			case 'contents':
				// get the file contents
				return file_get_contents($strPath);
				break;
				
			default:
				break;
		}

	}
}

?>
