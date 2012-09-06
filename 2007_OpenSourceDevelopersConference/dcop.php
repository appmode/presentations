<?php
require_once('token.php');
// DCOP Class
class Dcop
{
	public 	$arrPath = Array();
	private $_mtokToken;
	private $_strCommand;
	
	function __Construct($strApplication, $strUser=NULL, $strSession=NULL)
	{
		// application
		$strApplication 	= escapeshellarg($strApplication);
		
		// session
		if ($strSession)
		{
			$strSession 	= "--session ".escapeshellarg($strSession);
		}
		else
		{
			$strSession 	= "--all-sessions";
		}
		
		// user
		if ($strUser)
		{
			$strUser 		= "--user ".escapeshellarg($strUser);
		}
		else
		{
			$strUser 		= "--all-users";
		}
		
		// dcop base command
		$this->_strCommand 	= "dcop $strUser $strSession $strApplication";
		
		// instanciate multi level token
		$this->_mtokToken 	= new aphplixMultiLevelToken($this);
	}
	
	function __get($strName)
	{
		// clean path
		$this->arrPath = Array();
		
		// clean token
		$this->_mtokToken->NewPath($strName);
		
		// return token
		return $this->_mtokToken;
	}
	
	function __Call($strMethod, $arrArguments)
	{
		if (is_array($this->arrPath))
		{
			// set base command
			$strCommand = $this->_strCommand;
			
			// add path to command
			foreach($this->arrPath AS $strPath)
			{
				$strCommand .= " ".escapeshellarg($strPath);
			}
			
			// add method to command
			$strCommand .= " ".escapeshellarg($strMethod);
			
			// add arguments to command
			if (is_array($arrArguments))
			{
				foreach($arrArguments AS $intKey => $strArg)
				{
					$arrArguments[$intKey] = escapeshellarg($strArg);
				}
				$strCommand .= " ".implode(',', $arrArguments);
			}
			
			// run command
			return shell_exec($strCommand);
			
		}
		
		return FALSE;
	}
}

?>
