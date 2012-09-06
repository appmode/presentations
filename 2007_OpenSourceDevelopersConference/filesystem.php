<?php

// filesystem Class (object version)
class FileSystemObject
{
	private $_strPath;
	
	// Constructor
	function __Construct($strPath="/")
	{
		$this->_strPath = $strPath;
		
		// get contents of this directory
		$arrContents = @scandir($strPath);
		if ($arrContents)
		{
			foreach ($arrContents AS $strFileName)
			{
				// check if the entry is a directory
				if (is_dir($strPath.$strFileName) && $strFileName != "." && $strFileName != "..")
				{
					// create a new object for the directory
					$this->{$strFileName} = new FileSystemObject($strPath.$strFileName."/");
				}
			}
		}
	}
	
	function path($strFileName=NULL)
	{
		// show the path
		return $this->_strPath.$strFileName;
	}
	
	function exists($strFileName=NULL)
	{
		// check if the file exists
		return file_exists($this->_strPath.$strFileName);
	}
	
	function contents($strFileName=NULL)
	{
		// get the file contents
		return file_get_contents($this->_strPath.$strFileName);
	}
}

?>
